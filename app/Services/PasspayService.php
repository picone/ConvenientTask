<?php
/**
 * 云通付支付模块
 * User: ChienHo
 * Date: 16/9/26
 * Time: 下午4:13
 */

namespace App\Services;


class PasspayService{

    private $partner;
    private $key;

    public function __construct(){
        $this->partner=env('PASSPAY_PARTNEY');
        $this->key=env('PASSPAY_KEY');
    }

    /**
     * 对订单的参数进行签名
     * @param string $order_id 本地订单ID
     * @param string $subject 商品标题
     * @param float $fee 费用
     * @param string $notify_url 异步通知地址
     * @param string $return_url 同步跳转地址
     * @return string
     */
    public function signOrder($order_id,$subject,$body,$fee,$notify_url,$return_url){
        $src='body='.$body;
        $src.='&notify_url='.$notify_url;
        $src.='&out_order_no='.$order_id;
        $src.='&partner='.$this->partner;
        $src.='&return_url='.$return_url;
        $src.='&subject='.$subject;
        $src.='&total_fee='.$fee;
        $src.='&user_seller='.env('PASSPAY_ID');
        $src.=$this->key;
        return md5($src);
    }

    /**
     * 检查回调通知的签名是否合法
     * @param string $out_order_no 本地订单ID
     * @param string $total_fee 费用
     * @param string $trade_status 交易状态
     * @param string $sign 签名
     * @return bool
     */
    public function verify($out_order_no,$total_fee,$trade_status,$sign){
        if($trade_status!='TRADE_SUCCESS')return false;
        return md5($out_order_no.$total_fee.$trade_status.$this->partner.$this->key)===$sign;
    }
}
