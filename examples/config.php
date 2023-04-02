<?php

/**
 * QQ钱包商户信息配置文件
 */
$qqpay_config = [
    /**
     * 商户号
     */
    'mchid' => '',

    /**
     * 商户API密钥
     */
    'apikey' => '',

    /**
     * 应用APPID（仅APP支付需要）
     */
    'appid' => '',

    /**
     * 应用APPKEY（仅APP支付需要）
     */
    'appkey' => '',

    /**
     * 操作员账号（仅退款、撤销订单、企业付款时需要）
     * 
     * 创建操作员说明：https://kf.qq.com/faq/170112AZ7Fzm170112VNz6zE.html
     */
    'op_userid' => '',

    /**
     * 操作员密码
     */
    'op_userpwd' => '',

    /**
     * 商户证书路径（仅退款、撤销订单、企业付款时需要）
     * 
     * 商户证书说明：https://mp.qpay.tenpay.cn/buss/wiki/38/1192
     */
    'sslcert_path' => dirname(__FILE__).'/cert/apiclient_cert.pem',

    /**
     * 商户证书私钥路径
     */
    'sslkey_path' => dirname(__FILE__).'/cert/apiclient_key.pem',
];
return $qqpay_config;
