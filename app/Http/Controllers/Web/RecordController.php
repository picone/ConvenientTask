<?php

namespace App\Http\Controllers\Web;

use Json;
use Illuminate\Http\Request;
use App\Models\ConsumeLog;
use App\Http\Controllers\Controller;

class RecordController extends Controller{
    public function consume(Request $request){
        $data=ConsumeLog::select('id','type','money','relative_id')->where('user_id',$request->user()->id)->paginate(10)->toArray();
        foreach ($data['data'] as &$val){
            $val['way']=trans('constant.record_type.'.$val['type']);
        }
        return Json::response(1,$data);
    }
}
