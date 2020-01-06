<?php
namespace hejinke\payment;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-01-04
 * Time: 16:51
 */
class CurlRequest{

    static $instance;
    public $curl = '';

    private function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_HEADER, FALSE);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
    }

    public function setUrl( $url ){
        curl_setopt($this->curl,CURLOPT_URL, $url);

        if(stripos($url,"https://")!==FALSE){
            curl_setopt($this->curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }    else    {
            curl_setopt($this->curl,CURLOPT_SSL_VERIFYPEER,TRUE);
            curl_setopt($this->curl,CURLOPT_SSL_VERIFYHOST,2);//严格校验
        }

    }

    public function setUa( $ua ){
        curl_setopt($this->curl,CURLOPT_USERAGENT, $ua);
    }

    public function setTimeOut( $second = 30 ){
        curl_setopt( $this->curl , CURLOPT_TIMEOUT , $second );
    }

    Public function setProxy( $host , $port ){
        curl_setopt($this->curl,CURLOPT_PROXY, $host);
        curl_setopt($this->curl,CURLOPT_PROXYPORT, $port);
    }

    public function setCertAndKey( $cert , $key ){
        curl_setopt($this->curl,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($this->curl,CURLOPT_SSLCERT, $cert);
        curl_setopt($this->curl,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($this->curl,CURLOPT_SSLKEY, $key);
    }

    /**
     * @param $param
     * @return bool|string
     * @throws PaymentException
     */
    public function post( $param ){
        curl_setopt($this->curl, CURLOPT_POST, TRUE);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $param);
        return $this->exec();
    }


    /**
     * 统一发送请求
     * @return bool|string
     * @throws PaymentException
     */
    public function exec(){

        $data = curl_exec($this->curl);
        //返回结果
        if($data){
            curl_close($this->curl);
            return $data;
        } else {
            $error = curl_errno($this->curl);
            curl_close($this->curl);
            throw new PaymentException("curl出错，错误码:$error");
        }

    }


    public static function getInstance(){

        return self::$instance = new self();

    }

}