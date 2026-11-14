<?php

namespace QQPay;

/**
 * QQ钱包支付响应内容异常
 */
class QQPayException extends \Exception
{
    private $res = [];
    private $errCode;

    /**
     * @param array $res
     */
    public function __construct($res)
    {
        $res = is_array($res) ? $res : [];
        $this->res = $res;
        if (isset($res['err_code'])) {
            $this->errCode = $res['err_code'];
            $message = '['.$res['err_code'].']'.self::str($res['err_code_des'] ?? '');
        } elseif (isset($res['return_code'])) {
            $message = '['.$res['return_code'].']'.self::str($res['return_msg'] ?? '');
        } else {
            $message = '返回数据解析失败';
        }
        parent::__construct($message);
    }

    public function getResponse()
    {
        return $this->res;
    }

    private static function str($value)
    {
        return is_array($value) ? '' : (string)$value;
    }

    public function getErrCode()
    {
        return $this->errCode;
    }
}