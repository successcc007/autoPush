<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27
 * Time: 21:06
 */
include_once "curlClass.php";
$curl = new curlClass();
$pattern = "/<title>.*?<\/title>/";
$pattern = "/百度/";

var_dump($pattern);
$url ='www.baidu.com';
$cookie = '';
$content2= $curl->get_content($url,$cookie);

if(preg_match_all($pattern, $content2, $arr)){
    var_dump($arr);
}