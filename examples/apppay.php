<?php
/**
 * QQ钱包APP支付示例
 */

require __DIR__ . '/../vendor/autoload.php';
@header('Content-Type: text/html; charset=UTF-8');
$hostInfo = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

//引入配置文件
$qqpay_config = require('config.php');

//构造支付参数
$params = [
    'out_trade_no' => date("YmdHis").rand(111,999), //商户订单号
    'body' => 'sample body', //商品名称
    'fee_type' => 'CNY', //币种
    'notify_url' => $hostInfo.dirname($_SERVER['SCRIPT_NAME']).'/notify.php', //异步回调地址
    'spbill_create_ip' => $_SERVER['REMOTE_ADDR'], //支付用户IP
    'total_fee' => '150', //支付金额，单位：分
];

//发起支付请求
try {
    $client = new \QQPay\PaymentService($qqpay_config);
    $result = $client->appPay($params);
    $prepay_id = $result['prepay_id'];
    echo $prepay_id;
} catch (Exception $e) {
    echo 'QQ钱包支付下单失败！'.$e->getMessage();
}