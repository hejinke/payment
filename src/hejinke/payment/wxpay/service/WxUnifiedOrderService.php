<?php
namespace hejinke\payment\wxpay\service;
use hejinke\payment\wxpay\exception\WxModelException;
use hejinke\payment\wxpay\model\WxConfig;
use hejinke\payment\wxpay\model\WxUnifiedOrderModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-01-04
 * Time: 15:06
 */
class WxUnifiedOrderService extends WxService{

    public static function handle(WxConfig $wxConfig , WxUnifiedOrderModel $wxUnifiedOrderModel){

        self::$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

        if( !$wxUnifiedOrderModel->getNotifyUrl() )
            throw new WxModelException('缺少统一支付接口必填参数notify_url！');

        if( !$wxUnifiedOrderModel->getOutTradeNo() )
            throw new WxModelException('缺少统一支付接口必填参数out_trade_no！');

        if( !$wxUnifiedOrderModel->getBody() )
            throw new WxModelException('缺少统一支付接口必填参数body！');

        if( !$wxUnifiedOrderModel->getTotalFee() )
            throw new WxModelException('缺少统一支付接口必填参数total_fee！');

        if( !$wxUnifiedOrderModel->getTradeType() )
            throw new WxModelException('缺少统一支付接口必填参数trade_type！');

        if( $wxUnifiedOrderModel->getTradeType() == 'JSAPI' && !$wxUnifiedOrderModel->getOpenid() )
            throw new WxModelException('统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！');

        if( $wxUnifiedOrderModel->getTradeType() == 'NATIVE' && !$wxUnifiedOrderModel->getProductId() )
            throw new WxModelException('统一支付接口中，缺少必填参数product_id！trade_type为JSAPI时，product_id为必填参数！');

        $param = [];

        $param['appid'] = $wxConfig->getAppId();
        $param['mch_id'] = $wxConfig->getMchId();
        $wxUnifiedOrderModel->getDeviceInfo() && $param['device_info'] = $wxUnifiedOrderModel->getDeviceInfo();
        $param['nonce_str'] = $wxUnifiedOrderModel->getNonceStr();
        $wxUnifiedOrderModel->getSignType() && $param['sign_type'] = $wxUnifiedOrderModel->getSignType();
        $param['body'] = $wxUnifiedOrderModel->getBody();
        $wxUnifiedOrderModel->getDeviceInfo() && $param['detail'] = $wxUnifiedOrderModel->getDetail();
        $wxUnifiedOrderModel->getAttach() && $param['attach'] = $wxUnifiedOrderModel->getAttach();
        $param['out_trade_no'] = $wxUnifiedOrderModel->getOutTradeNo();
        $wxUnifiedOrderModel->getFeeType() && $param['fee_type'] = $wxUnifiedOrderModel->getFeeType();
        $wxUnifiedOrderModel->getTotalFee() && $param['total_fee'] = $wxUnifiedOrderModel->getTotalFee();
        $param['spbill_create_ip'] = $wxUnifiedOrderModel->getSpbillCreateIp();
        $wxUnifiedOrderModel->getTimeStart() && $param['time_start'] = $wxUnifiedOrderModel->getTimeStart();
        $wxUnifiedOrderModel->getTimeExpire() && $param['time_expire'] = $wxUnifiedOrderModel->getTimeExpire();
        $wxUnifiedOrderModel->getGoodsTag() && $param['goods_tag'] = $wxUnifiedOrderModel->getGoodsTag();
        $param['notify_url'] = $wxUnifiedOrderModel->getNotifyUrl();
        $param['trade_type'] = $wxUnifiedOrderModel->getTradeType();
        $wxUnifiedOrderModel->getProductId() && $param['product_id'] = $wxUnifiedOrderModel->getProductId();
        $wxUnifiedOrderModel->getLimitPay() && $param['limit_pay'] = $wxUnifiedOrderModel->getLimitPay();
        $wxUnifiedOrderModel->getOpenid() && $param['openid'] = $wxUnifiedOrderModel->getOpenid();
        $wxUnifiedOrderModel->getReceipt() && $param['receipt'] = $wxUnifiedOrderModel->getReceipt();
        $wxUnifiedOrderModel->getSceneInfo() && $param['receipt'] = $wxUnifiedOrderModel->getSceneInfo();

        return self::unifiedRequest( $wxConfig , $param );



    }



}