<?php
/**
 * 统一收单交易退款查询
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 16:24
 */
namespace AliPay\Pay;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayPayException;

class RefundQuery extends AliPayBase
{
    /**
     * 商户订单号
     *
     * @var string
     */
    private $out_trade_no = '';
    /**
     * 支付宝交易号
     *
     * @var string
     */
    private $trade_no = '';
    /**
     * 退款单号
     *
     * @var string
     */
    private $out_request_no = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.trade.fastpay.refund.query');
    }

    private function __clone()
    {
    }

    /**
     * @param string $outTradeNo
     *
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setOutTradeNo(string $outTradeNo)
    {
        if (ctype_digit($outTradeNo)) {
            $this->biz_content['out_trade_no'] = $outTradeNo;
        } else {
            throw new AliPayPayException('商户订单号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $tradeNo
     *
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setTradeNo(string $tradeNo)
    {
        if (ctype_digit($tradeNo)) {
            $this->biz_content['trade_no'] = $tradeNo;
        } else {
            throw new AliPayPayException('支付宝交易号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @param string $refundNo
     *
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setRefundNo(string $refundNo)
    {
        if (ctype_digit($refundNo)) {
            $this->biz_content['out_request_no'] = $refundNo;
        } else {
            throw new AliPayPayException('退款单号不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if ((!isset($this->biz_content['out_trade_no'])) && !isset($this->biz_content['trade_no'])) {
            throw new AliPayPayException('商户订单号和支付宝交易号不能都为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
        if (!isset($this->biz_content['out_request_no'])) {
            throw new AliPayPayException('退款单号不能为空', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
