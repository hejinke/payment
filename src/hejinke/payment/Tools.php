<?php
namespace hejinke\payment;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020-01-04
 * Time: 13:56
 */
class Tools{

    public function __construct()
    {
    }

    public static function hello(){
        echo "hello world!";
    }

    //驼峰命名转下划线命名
    function toUnderScore($str)
    {
        $dstr = preg_replace_callback('/([A-Z]+)/',function($matchs)
        {
            return '_'.strtolower($matchs[0]);
        },$str);
        return trim(preg_replace('/_{2,}/','_',$dstr),'_');
    }

    //下划线命名到驼峰命名
    function toCamelCase($str)
    {
        $array = explode('_', $str);
        $result = $array[0];
        $len=count($array);
        if($len>1)
        {
            for($i=1;$i<$len;$i++)
            {
                $result.= ucfirst($array[$i]);
            }
        }
        return $result;
    }

    public static function xmlToArray( $xml ){

        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

    }
}