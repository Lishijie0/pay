<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-09
 * Time: 0:42
 */
namespace SyException\AliPay;

use SyException\BaseException;

class AliPayAuthException extends BaseException
{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
        $this->tipName = '支付宝授权异常';
    }
}
