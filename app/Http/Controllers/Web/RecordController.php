<?php

namespace App\Http\Controllers\Web;

use Json;
use Illuminate\Http\Request;
use App\Models\ConsumeLog;
use App\Models\Indent;
use App\Models\Withdraw;
use App\Http\Controllers\Controller;

class RecordController extends Controller{
    public function consume(Request $request){
        $data=ConsumeLog::select('id','type','money','relative_id')->where('user_id',$request->user()->id)->paginate(2)->toArray();
        foreach ($data['data'] as &$val){
            $val['way']=trans('constant.record_type.'.$val['type']);
        }
        return Json::response(1,$data);
    }

    public function indent(Request $request){
        $data=Indent::select('id','money','real_money','status','created_at')->where('user_id',$request->user()->id)->paginate(10)->toArray();
        foreach($data['data'] as &$val){
            $val['status']=trans('constant.indent_status.'.$val['status']);
        }
        return Json::response(1,$data);
    }

    public function withdraw(Request $request){
        $data=Withdraw::select('id','money','real_money','status','create_time','finish_time')->where('user_id',$request->user()->id)->paginate(10)->toArray();
        foreach($data['data'] as &$val){
            $val['status']=trans('constant.withdraw_status.'.$val['status']);
        }
        return Json::response(1,$data);
    }
}
