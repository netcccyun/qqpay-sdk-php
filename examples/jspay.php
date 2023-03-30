<?php
/**
 * QQ钱包JSAPI支付示例
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
    $result = $client->jsapiPay($params);
    $prepay_id = $result['prepay_id'];
} catch (Exception $e) {
    echo 'QQ钱包支付下单失败！'.$e->getMessage();
    exit;
}
$mchappid = $qqpay_config['appid'];
$mchid = $qqpay_config['mchid'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link href="//cdn.staticfile.org/ionic/1.3.2/css/ionic.min.css" rel="stylesheet" />
</head>
<body>
<div class="bar bar-header bar-light" align-title="center">
	<h1 class="title">QQ钱包支付</h1>
</div>
<div class="has-header" style="padding: 5px;position: absolute;width: 100%;">
<div class="text-center" style="color: #a09ee5;">
<i class="icon ion-information-circled" style="font-size: 80px;"></i><br>
<span>正在跳转...</span>
<script src="//open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
<script>
	document.body.addEventListener('touchmove', function (event) {
		event.preventDefault();
	},{ passive: false });

	function callpay()
	{
		mqq.tenpay.pay({
			tokenId: '<?php echo $prepay_id; ?>',
			appInfo: "appid#<?php echo $mchappid;?>|bargainor_id#<?php echo $mchid;?>|channel#wallet"
		}, function(result, resultCode){
			if(result.resultCode == 0){ //支付成功
				alert('支付成功')
			}
		});
	}
    window.onload = callpay();
</script>
</div>
</div>
</body>
</html>