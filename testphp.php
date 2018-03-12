<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27
 * Time: 21:06
 */
/* post text and image*/
/*
include_once 'imgAndText.php';
$imgAndText= new imgAndText();
$text_data = [
    'username' => 'Tom111',
    'password' => '1234562222',
];
$img_data = [
    'a.jpg' => @'upload/0.jpg',
    'b.jpg' => @'upload/1.jpg'
];

$url = 'localhost/autoPush/respose.php'; // 服务器URL，根据实际情况进行修改
$result =$imgAndText->SendData($url,$text_data,$img_data);
var_dump($result);
*/
include_once 'imgAddText.php';
$imgAdd = new imgAddText();
$text = '123456789';
$bigImgPath = @'upload/0.jpg';
$savePath = @'upload/00.jpg';

$imgAdd->AddText($bigImgPath,$text,$savePath);
