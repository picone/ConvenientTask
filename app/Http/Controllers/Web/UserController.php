<?php

namespace App\Http\Controllers\Web;

use Json,UcClient,Cache,Session,Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Indent;
use App\Http\Controllers\Controller;
use VergilLai\UcClient\Exceptions\UcException;
use Gregwar\Captcha\CaptchaBuilder;
use App\Facades\Passpay;

class UserController extends Controller{

    /**
     * 登录
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request){
        $client_ip=$request->getClientIp();
        if(Cache::get('error_'.$client_ip,0)>5)return Json::response(100);
        if($request->input('captcha')==''||Session::get('captcha','')!=$request->input('captcha'))return Json::response(101);
        try {
            $user=UcClient::userLogin($request->input('username'),$request->input('password'));
            $result=[
                'username'=>$user['username'],
                'uid'=>$user['uid']
            ];
            User::firstOrCreate(['id'=>$user['uid']],['id'=>$user['uid'],'username'=>$user['username'],'email'=>$user['email']]);
            Auth::loginUsingId($user['uid'],$request->input('remember',true));
            return Json::response(1,$result);
        }catch(UcException $e){
            if($e->getCode()==-2){//密码错误
                if(Cache::has('error_'.$client_ip)){
                    Cache::increment('error_'.$client_ip);
                }else{
                    Cache::add('error_'.$client_ip,1,15);
                }
            }
            return Json::response(11,null,$e->getMessage());
        }
    }

    /**
     * 登出
     * @return mixed
     */
    public function logout(){
        Auth::logout();
        return Json::response();
    }

    /**
     * 获取个人资料
     * @param Request $request
     * @return mixed
     */
    public function profile(Request $request){
        $user=$request->user();
        $result=[
            'uid'=>$user->id,
            'username'=>$user->username,
            'money'=>$user->money
        ];
        return Json::response(1,$result);
    }

    /**
     * 发起支付请求
     * @param Request $request
     * @return mixed
     */
    public function deposit(Request $request){
        $order=new Indent;
        $order->user_id=$request->user()->id;
        $order->money=round($request->input('money',0),2);
        if($order->money<=0){
            return redirect('/#!/center/deposit');
        }
        $subject='"方便接"充值'.$order->money.'元';
        $body='梦殇国际www.714.hk';
        $return_url=route('web:index');
        switch($request->input('type',1)){
            case 1:{//云通付
                $notify_url=route('web:user:passpay');
                $order->type=1;
                $order->real_money=round($order->money*0.985,2);
                $order->save();
                return view('passpay',[
                    'body'=>$body,
                    'notify_url'=>$notify_url,
                    'order_id'=>$order->id,
                    'partner'=>env('PASSPAY_PARTNER'),
                    'return_url'=>$return_url,
                    'subject'=>$subject,
                    'money'=>$order->money,
                    'seller_id'=>env('PASSPAY_ID'),
                    'sign'=>Passpay::signOrder($order->id,$subject,$body,$order->money,$notify_url,$return_url)
                ]);
                break;
            }
        }
        return view('error/503');
    }

    /**
     * 云通付回调通知
     * @param Request $request
     * @return mixed
     */
    //TODO:测试
    public function passpay(Request $request){
        if(Passpay::verify($request->input('out_order_no'),$request->input('total_fee'),$request->input('trade_status'),$request->input('sign'))){
            $order=Indent::find($request->input('out_order_no'));
            if($order&&$order->money==$request->input('total_fee')){
                DB::transaction(function() use($order,$request){
                    DB::table('indents')->where('id',$order->id)->update([
                        'order'=>$request->input('trade_no'),
                        'status'=>1
                    ]);
                    DB::table('users')->where('id',$order->user_id)->increment('money',$order->real_money);
                    DB::table('consume_logs')->insert([
                        'user_id'=>$order->user_id,
                        'money'=>$order->real_money,
                        'type'=>0,
                        'relative_id'=>$order->id
                    ]);
                });
                return response('ok');
            }
        }
        return response('fail');
    }
}
