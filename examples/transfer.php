<?php
/**
 * QQ钱包企业付款示例
 */

require __DIR__ . '/../vendor/autoload.php';
@header('Content-Type: text/html; charset=UTF-8');

//引入配置文件
$qqpay_config = require('config.php');

$out_trade_no = date("YmdHis").rand(111,999); //商户转账唯一订单号
$money = '150'; //转账金额，单位：分
$payee_account = ''; //收款QQ号码
$payee_real_name = ''; //用户姓名（留空则不校验姓名）
$memo = '备注内容'; //转账备注

//发起转账请求
try {
    $client = new \QQPay\TransferService($qqpay_config);
    $result = $client->transfer($out_trade_no, $payee_account, $payee_real_name, $money, $memo);
    echo '转账成功！QQ钱包转账订单号：'.$result['transaction_id'];
} catch (Exception $e) {
    echo '转账失败！'.$e->getMessage();
}
