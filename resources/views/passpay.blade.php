<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>订单跳转页...</title>
</head>
<body>
<form id="passpaysubmit" name="passpaysubmit" action="http://www.passpay.net/PayOrder/payorder" method="POST">
    <input type="hidden" name="body" value="{{ $body }}">
    <input type="hidden" name="notify_url" value="{{ $notify_url }}">
    <input type="hidden" name="out_order_no" value="{{ $order_id }}">
    <input type="hidden" name="partner" value="{{ $partner }}">
    <input type="hidden" name="return_url" value="{{ $return_url }}">
    <input type="hidden" name="subject" value="{{ $subject }}">
    <input type="hidden" name="total_fee" value="{{ $money }}">
    <input type="hidden" name="user_seller" value="{{ $seller_id }}">
    <input type="hidden" name="sign" value="{{ $sign }}">
    <input type="submit" value="如长时间没反应请点击这里">
</form>
<script>document.forms['passpaysubmit1'].submit();</script>
</body>
</html>