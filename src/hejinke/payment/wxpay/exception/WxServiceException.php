<?php
namespace hejinke\payment\wxpay\exception;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-01-04
 * Time: 15:18
 */
class WxServiceException extends \Exception{

    public function errorMessage(){
        return $this->getMessage();
    }

}