<?php
/**
 * Created by PhpStorm.
 * User: ChienHo
 * Date: 16/9/26
 * Time: 下午4:35
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Passpay extends Facade{
    protected static function getFacadeAccessor(){
        return 'passpay';
    }
}
