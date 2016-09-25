<?php

namespace App\Http\Controllers\Web;

use Json,UcClient,Cache,Session,Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Http\Controllers\Controller;
use VergilLai\UcClient\Exceptions\UcException;
use Gregwar\Captcha\CaptchaBuilder;

class UserController extends Controller{

    /**
     * 登录
     * @param Request $request
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

    public function profile(){

    }
}
