<?php
namespace hejinke\payment\wxpay\service;
use hejinke\payment\CurlRequest;
use hejinke\payment\PaymentException;
use hejinke\payment\Tools;
use hejinke\payment\wxpay\exception\WxModelException;
use hejinke\payment\wxpay\exception\WxServiceException;
use hejinke\payment\wxpay\model\WxConfig;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-01-04
 * Time: 15:21
 */
class WxService{

    static $url = '';
    static $useCert = false;
    static $signType = 'MD5';

    protected static function unifiedRequest( WxConfig $wxConfig , $param ){

        $param['sign'] = self::makeSign( $wxConfig , $param );

        isset( $param['sign_type'] ) && self::$signType = $param['sign_type'];

        $xml = self::ToXml( $param );
        //请求开始时间
        $startTimeStamp = self::getMillisecond();
        // 发起请求
        // $response = self::postXmlCurl($wxConfig, $xml, self::$url, false, $timeOut);
        $request = CurlRequest::getInstance();

        $request->setUrl( self::$url );
        $ua = "WXPaySDK/3.0.9 (".PHP_OS.") PHP/".PHP_VERSION." CURL/".curl_version()." "
            .$wxConfig->getMchId();
        $request->setUa( $ua );
        $request->setTimeOut();
        if( self::$useCert ){
            $request->setCertAndKey( $wxConfig->getSslCertPath() , $wxConfig->getSslKeyPath() );
        }



        $remote = $request->post($xml);

        if( !$remote )
            throw new PaymentException('网络请求返回异常！');

        $result = Tools::xmlToArray( $remote );

        if( $result['return_code'] != 'SUCCESS' ){
            foreach ($result as $key => $value) {
                if($key != "return_code" && $key != "return_msg"){
                    throw new PaymentException("输入数据存在异常！");
                    return false;
                }
            }
            throw new PaymentException($result['return_msg']);
            // return $result;
        }
        self::checkSign( $result , $wxConfig );

        return $result;





        // $result = WxPayResults::Init($config, $response);
    }

    //
    private static function checkSign( $result , WxConfig $wxConfig ){

        if( !isset( $result['sign'] ) || !$result['sign'] )
            throw new PaymentException('签名错误！');

        ksort( $result );
        $string = self::ToUrlParams( $result );
        $string .= '&key='.$wxConfig->getPaySecret();
        if( self::$signType == 'MD5' ){
            $string = md5( $string );
        }else if( self::$signType == 'HMAC-SHA256' ){
            $string = hash_hmac("sha256",$string ,$wxConfig->getSslKeyPath());
        }else{
            throw new WxServiceException("签名类型不支持！");
        }

        return strtoupper($string);

    }

    private static function ToXml( $param )
    {
        if(!is_array($param)
            || count($param) <= 0)
        {
            throw new WxModelException("数组数据异常！");
        }

        $xml = "<xml>";
        foreach ($param as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    // 二次签名
    protected static function twoSign(){

    }


    protected static function makeSign( WxConfig $wxConfig , $param ){

        ksort( $param );

        $string = self::ToUrlParams( $param );
        $string = $string."&key=".$wxConfig->getPaySecret();

        return strtoupper(md5( $string ));

    }

    /**
     * 格式化参数格式化成url参数
     */
    private static function ToUrlParams( $param )
    {
        $buff = "";
        foreach ($param as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }


    /**
     * 获取毫秒级别的时间戳
     */
    protected static function getMillisecond()
    {
        //获取毫秒的时间戳
        $time = explode ( " ", microtime () );
        $time = $time[1] . ($time[0] * 1000);
        $time2 = explode( ".", $time );
        $time = $time2[0];
        return $time;
    }
}