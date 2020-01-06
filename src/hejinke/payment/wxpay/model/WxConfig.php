<?php
namespace hejinke\payment\wxpay\model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-01-04
 * Time: 13:53
 */
class WxConfig
{
    //=======【基本信息设置】=====================================
    //
    /**
     * TODO: 修改这里配置为您自己申请的商户信息
     * 微信公众号信息配置
     *
     * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
     *
     * MCHID：商户号（必须配置，开户邮件中可查看）
     *
     * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
     * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
     *
     * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置），
     * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
     * @var string
     */
    private $app_id;
    private $mch_id;
    private $pay_secret;
    private $app_secret;
    //=======【证书路径设置】=====================================
    /**
     * TODO：设置商户证书路径
     * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
     * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
     * @var path
     */
    private $ssl_cert_path;
    private $ssl_key_path;
    //=======【curl代理设置】===================================
    /**
     * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
     * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
     * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
     * @var unknown_type
     */
    private $curl_proxy_host;
    private $curl_proxy_port;

    //=======【上报信息配置】===================================
    /**
     * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
     * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
     * 开启错误上报。
     * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
     * @var int
     */
    private $report_levenl;

    public function setAppId($app_id)
    {
        $this->app_id = $app_id;
    }

    public function getAppId()
    {
        return $this->app_id;
    }

    public function setMchId($mch_id)
    {
        $this->mch_id = $mch_id;
    }

    public function getMchId()
    {
        return $this->mch_id;
    }

    public function setPaySecret($pay_secret)
    {
        $this->pay_secret = $pay_secret;
    }

    public function getPaySecret()
    {
        return $this->pay_secret;
    }

    public function setAppSecret($app_secret)
    {
        $this->app_secret = $app_secret;
    }

    public function getAppSecret()
    {
        return $this->app_secret;
    }

    public function setSslCertPath($ssl_cert_path)
    {
        $this->ssl_cert_path = $ssl_cert_path;
    }

    public function getSslCertPath()
    {
        return $this->ssl_cert_path;
    }

    public function setSslKeyPath($ssl_key_path)
    {
        $this->ssl_key_path = $ssl_key_path;
    }

    public function getSslKeyPath()
    {
        return $this->ssl_key_path;
    }

    public function setCurlProxyHost($curl_proxy_host)
    {
        $this->curl_proxy_host = $curl_proxy_host;
    }

    public function getCurlProxyHost()
    {
        return $this->curl_proxy_host;
    }

    public function setCurlProxyPort($curl_proxy_port)
    {
        $this->curl_proxy_port = $curl_proxy_port;
    }

    public function getCurlProxyPort()
    {
        return $this->curl_proxy_port;
    }

    public function setReportLevenl($report_levenl)
    {
        $this->report_levenl = $report_levenl;
    }

    public function getReportLevenl()
    {
        return $this->report_levenl;
    }
}