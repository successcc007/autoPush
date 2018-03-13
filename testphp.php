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
$waterImg = @'upload/00.jpg';
$saveTextPath = @'upload/text.jpg';
$saveImgPath = @'upload/img.jpg';

$imgAdd->AddText($bigImgPath,$text,$saveTextPath);

$imgAdd->AddImg($bigImgPath,$waterImg,$saveImgPath);



/*fenben*/






/*板块*/
/*
if (empty($content_city)) {
    echo 'city fail';
} else {
    echo 'city succeed';
    $bankuai = 'women > men';
    $pattern_bankuai = "/<a href=\"(.*)?\">" . $bankuai . "<\/a>/";
    if (preg_match_all($pattern_bankuai, $content_city, $arr_bankuai)) {
        var_dump($arr_bankuai[1]);
        $url_bankuai = $arr_bankuai[1];
        if (empty($url_bankuai)) {
            echo 'bankuai url fail';
        } else {
            echo 'bankuai url succeed';
            $content_bankuai = $url->get_content($url_bankuai, $cookie);
        }
    }
}
*/
/*i agree*/
/*
if (empty($content_bankuai)) {
    echo 'bankuai fail';
} else {
    echo 'bankuai succeed';
    $continue = 'I agree';
    $pattern_continue = "/<a href=\"(.*)?\">" . $continue . "<\/a>/";
    if (preg_match_all($pattern_continue, $content_bankuai, $arr_continue)) {
        var_dump($arr_continue[1]);
        $url_continue = $arr_continue[1];
        if (empty($url_continue)) {
            echo 'continue url fail';
        } else {
            echo 'continue url succeed';
            $content_continue = $url->get_content($url_continue, $cookie);
        }
    }
}
*/

