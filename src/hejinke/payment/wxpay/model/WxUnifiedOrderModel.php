<?php
namespace hejinke\payment\wxpay\model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-01-04
 * Time: 07:02
 */
class WxUnifiedOrderModel
{
    private $openid;
    private $device_info;
    private $nonce_str;
    private $body;
    private $detail;
    private $attach;
    private $out_trade_no;
    private $fee_type;
    private $total_fee;
    private $spbill_create_ip;
    private $time_start;
    private $time_expire;
    private $goods_tag;
    private $notify_url;
    private $trade_type;
    private $product_id;
    private $prepay_id;
    private $timestamp;
    private $package;
    private $sign_type;
    private $limit_pay;
    private $receipt;
    private $scene_info;

    public function getSignType(){
        return $this->sign_type;
    }

    public function setSignType( $sign_type ){
        return $this->sign_type = $sign_type;
    }

    public function setOpenid($openid)
    {
        $this->openid = $openid;
    }

    public function getOpenid()
    {
        return $this->openid;
    }

    public function setDeviceInfo($device_info)
    {
        $this->device_info = $device_info;
    }

    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    public function setNonceStr($nonce_str)
    {
        $this->nonce_str = $nonce_str;
    }

    public function getNonceStr()
    {
        return $this->nonce_str;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function setAttach($attach)
    {
        $this->attach = $attach;
    }

    public function getAttach()
    {
        return $this->attach;
    }

    public function setOutTradeNo($out_trade_no)
    {
        $this->out_trade_no = $out_trade_no;
    }

    public function getOutTradeNo()
    {
        return $this->out_trade_no;
    }

    public function setFeeType($fee_type)
    {
        $this->fee_type = $fee_type;
    }

    public function getFeeType()
    {
        return $this->fee_type;
    }

    public function setTotalFee($total_fee)
    {
        $this->total_fee = $total_fee;
    }

    public function getTotalFee()
    {
        return $this->total_fee;
    }

    public function setSpbillCreateIp($spbill_create_ip)
    {
        $this->spbill_create_ip = $spbill_create_ip;
    }

    public function getSpbillCreateIp()
    {
        return $this->spbill_create_ip;
    }

    public function setTimeStart($time_start)
    {
        $this->time_start = $time_start;
    }

    public function getTimeStart()
    {
        return $this->time_start;
    }

    public function setTimeExpire($time_expire)
    {
        $this->time_expire = $time_expire;
    }

    public function getTimeExpire()
    {
        return $this->time_expire;
    }

    public function setGoodsTag($goods_tag)
    {
        $this->goods_tag = $goods_tag;
    }

    public function getGoodsTag()
    {
        return $this->goods_tag;
    }

    public function setNotifyUrl($notify_url)
    {
        $this->notify_url = $notify_url;
    }

    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    public function setTradeType($trade_type)
    {
        $this->trade_type = $trade_type;
    }

    public function getTradeType()
    {
        return $this->trade_type;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setPrepayId($prepay_id)
    {
        $this->prepay_id = $prepay_id;
    }

    public function getPrepayId()
    {
        return $this->prepay_id;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setPackage($package)
    {
        $this->package = $package;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function getLimitPay()
    {
        return $this->limit_pay;
    }
    public function setLimitPay( $limit_pay )
    {
        $this->limit_pay = $limit_pay;
    }

    public function getReceipt()
    {
        return $this->receipt;
    }

    public function setReceipt($receipt)
    {
        $this->receipt = $receipt;
    }

    public function getSceneInfo()
    {
        return $this->scene_info;
    }

    public function setSceneInfo( $scene_info )
    {
        $this->scene_info = $scene_info;
    }

}