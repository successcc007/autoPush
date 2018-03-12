<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23
 * Time: 21:18
 */
include_once "curlClass.php";
$curl = new curlClass();

/*登录*/
$data_login = array(
    'loginAttempt' => 'true',
    'lang' => 'en-us',
    'return' => '',
    'site' => '',
    'ad' => '',
//    'rememberMe' => 'remember',
    'email' => 'bp1@biteveryday.com',
    'password' => 'Ped.,_eo123'
);
$cookie = dirname(__FILE__) . "/" . 'cookie.txt'; //设置cookie保存的路径
/*
$url_login = "https://my.backpage.com/classifieds/central/index";
$rs_login =$curl->login_post($url_login, $cookie,$data_login);
if(!$rs_login){
   echo 'login fail';
}else{
    echo 'login succeed';
}
echo '<br>';
*/
/*城市选择*/
$city = "Seattle";
//$url_allCity="https://my.backpage.com/classifieds/AllCities";
$url_allCity = "http://www.backpage.com/";
$content_allCity = $curl->get_content($url_allCity, $cookie);
if (empty($content_allCity)) {
    echo 'allcity fail<br>';
} else {
    echo 'allcity succeed<br>';
    $pattern_City = "/<a href=\"(.*)?\">" . $city . "<\/a>/";
    if (preg_match_all($pattern_City, $content_allCity, $arr_City)) {
        var_dump($arr_City[1]);
        $url_city = $arr_City[1][0];
        if (empty($url_city)) {
                echo 'city url fail<br>';
        } else {
            echo 'city url succeed<br>';
            $content_city = $curl->get_content($url_city, $cookie);
        }
    }
}


/*ad*/
if (empty($content_city)) {
    echo 'city fail<br>';
} else {
    echo 'city succeed<br>';
    $pattern_ad_url = "/<form name=\"formPost\" id=\"formPost\" action=\"(.*)?\" method=\"get\">/";
    $pattern_ad_u ="/<input type=\"hidden\" name=\"u\" value=\"(.*)?\">/";
    $pattern_ad_serverName ="/<input type=\"hidden\" name=\"serverName\" value=\"(.*)?\">/";
    preg_match_all($pattern_ad_url, $content_city, $arr_ad);
    preg_match_all($pattern_ad_u, $content_city, $pattern_ad_u);
    preg_match_all($pattern_ad_serverName, $content_city, $pattern_ad_serverName);
    $url_ad = $arr_ad[1][0];
    $data_u = $pattern_ad_u[1][0];
    $data_serverName = $pattern_ad_serverName[1][0];
    var_dump($url_ad);
    var_dump($data_u);
    var_dump($data_serverName);

    $data_ad = array(
        'u' => $data_u,
        'serverName' => $data_serverName
    );
    $content_ad = $curl->get_content_post($url_ad, $cookie,$data_ad);
}

/*dating*/
$dating ='dating';
if (empty($content_ad)) {
    echo 'ad fail<br>';
} else {
    echo 'ad succeed<br>';
    $pattern_dating_url = "/<a href=\"(.*)?\" data-section=\"(.*)?\" data-name=\"".$dating."\">".$dating."<\/a>/";
    preg_match_all($pattern_dating_url, $content_ad, $arr_dating);
    $url_dating = $arr_dating[1][0];
    $url_dating=substr($url_ad,0,strpos($url_ad,'.com')+4).$arr_dating[1][0];
    var_dump($url_dating);
   // var_dump(substr($url_ad,0,strpos($url_ad,'.com')+4));
    $content_dating  = $curl->get_content($url_dating, $cookie);
}


/*women man*/
$women_men ='women seeking men';
if (empty($content_dating)) {
    echo 'dating fail<br>';
} else {
    echo 'dating succeed<br>';
    $pattern_women_men_url = "/<a href=\"(.*)?\" data-category=\"(.*)?\" data-name=\"".$women_men."\" data-useRegions=\"yes\" data-disclaimer=\"yes\">".$women_men."<\/a>/";
    preg_match_all($pattern_women_men_url, $content_dating, $arr_women_men);
    $url_women_men = $arr_women_men[1][0];
    $url_women_men=substr($url_ad,0,strpos($url_ad,'.com')+4).$arr_women_men[1][0];
    var_dump($url_women_men);
    $content_women_men  = $curl->get_content($url_women_men, $cookie);
}



/*location*/
$location ='Bellingham';
if (empty($content_women_men)) {
    echo 'location fail<br>';
} else {
    echo 'location succeed<br>';
    $pattern_location = "/<a href=\"(.*)?\" data-superRegion=\"".$location."\" data-multiple=\"no\">".$location."<\/a>/";
    preg_match_all($pattern_location, $content_women_men, $arr_location);
    $url_local = $arr_location[1][0];
    $url_local=substr($url_ad,0,strpos($url_ad,'.com')+4).$arr_location[1][0];
    var_dump($url_local);
    $content_local  = $curl->get_content($url_local, $cookie);
}
