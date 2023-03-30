<?php
/**
 * QQ钱包APP异步回调页面示例
 */

require __DIR__ . '/../vendor/autoload.php';

//引入配置文件
$qqpay_config = require('config.php');

$isSuccess = true;
try{
    $client = new \QQPay\PaymentService($qqpay_config);
    $data = $client->notify();
    //签名校验成功且订单支付成功，根据商户订单号($data['out_trade_no'])在商户系统中处理业务


}catch(Exception $e){
    //签名校验失败或订单支付失败
    $isSuccess = false;
    $errmsg = $e->getMessage();
}

//给QQ钱包返回的内容
$client->replyNotify($isSuccess, $errmsg);
