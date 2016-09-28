<?php

namespace App\Http\Controllers\Web;

use Session,Json;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;

class CommonController extends Controller{
    public function captcha(){
        $builder=new CaptchaBuilder;
        $builder->build(150,60);
        $builder->output();
        Session::flash('captcha',$builder->getPhrase());
        return response('')->header('Content-type','image/jpeg');
    }

    public function getName($name){
        return Json::response(1,trans($name));
    }
}
