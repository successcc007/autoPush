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
    echo 'allcity fail';
} else {
    echo 'allcity succeed';
    $pattern_City = "/<a href=\"(.*)?\">" . $city . "<\/a>/";
    if (preg_match_all($pattern_City, $content_allCity, $arr_City)) {
        var_dump($arr_City[1]);
        $url_city = $arr_City[1];
        if (empty($content_city_url)) {
            echo 'city url fail';
        } else {
            echo 'city url succeed';
            $content_city = $curl->get_content($url_city, $cookie);
        }
    }
}

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

/*ad*/
if (empty($content_city)) {
    echo 'city fail';
} else {
    echo 'city succeed';
    $pattern_ad_url = "/<form name=\"formPost\" id=\"formPost\" action=\"(.*)?\" method=\"get\">/";
    $pattern_ad_u ="/<input type=\"hidden\" name=\"u\" value=\"(.*)?\">/";
    $pattern_ad_serverName ="/<input type=\"hidden\" name=\"serverName\" value=\"(.*)?\">/";
    preg_match_all($pattern_ad_url, $content_city, $arr_ad);
    preg_match_all($pattern_ad_u, $content_city, $pattern_ad_u);
    preg_match_all($pattern_ad_serverName, $content_city, $pattern_ad_serverName);
    $url_ad = $arr_ad[1];
    $data_u = $pattern_ad_u[1];
    $data_serverName = $pattern_ad_serverName[1];
    $data_ad = array(
        'u' => $data_u,
        'serverName' => $data_serverName
    );
    $content_ad = $curl->get_content_post($url_ad, $cookie,$data_ad);
}

/*dating*/
$dating ='dating';
if (empty($content_ad)) {
    echo 'ad fail';
} else {
    echo 'ad succeed';
    $pattern_dating_url = "/<a href=\"(.*)?\" data-section=\"(.*)?\" data-name=\"".$dating."\">".$dating."<\/a>/";
    preg_match_all($pattern_dating_url, $content_ad, $arr_dating);
    $url_dating = $arr_dating[1];
    $content_dating  = $curl->get_content($url_dating, $cookie);
}

/*women man*/
$women_men ='women seeking men';
if (empty($content_dating)) {
    echo 'dating fail';
} else {
    echo 'dating succeed';
    $pattern_women_men_url = "/<a href=\"(.*)?\" data-category=\"(.*)?\" data-name=\"".$women_men."\" data-useRegions=\"yes\" data-disclaimer=\"yes\">".$women_men."<\/a>/";
    preg_match_all($pattern_women_men_url, $content_dating, $arr_women_men);
    $url_women_men = $arr_women_men[1];
    $content_women_men  = $curl->get_content($url_women_men, $cookie);
}

/*location*/
$location ='Bellingham';
if (empty($content_women_men)) {
    echo 'location fail';
} else {
    echo 'location succeed';
    $pattern_location = "/<a href=\"(.*)?\" data-superRegion=\"".$location."\" data-multiple=\"no\">".$location."<\/a>/";
    preg_match_all($pattern_location, $content_women_men, $arr_location);
    $url_local = $arr_location[1];
    $content_local  = $curl->get_content($url_local, $cookie);
}

/*continue*/
if (empty($content_local)) {
    echo 'local fail';
} else {
    echo 'local succeed';
    $pattern_continue_url = "/<form name=\"formDisclaimer\" method=\"post\" action=\"(.*)?\">/";
    $pattern_continue_disc ="/<input type=\"hidden\" name=\"disc\" value=\"(.*)?\">/";
    $pattern_continue_category ="/<input type=\"hidden\" name=\"category\" value=\"(.*)?\">/";
    $pattern_continue_section ="/<input type=\"hidden\" name=\"section\" value=\"(.*)?\">/";
    $pattern_continue_serverName ="/ <input type=\"hidden\" name=\"serverName\" value=\"(.*)?\">/";
    $pattern_continue_superRegion ="/<input type=\"hidden\" name=\"superRegion\" value=\"(.*)?\">/";
    $pattern_continue_u ="/<input type=\"hidden\" name=\"u\" value=\"(.*)?\">/";
    preg_match_all($pattern_continue_url, $content_local, $arr_continue);
    preg_match_all($pattern_continue_disc, $content_local, $arr_disc);
    preg_match_all($pattern_continue_category, $content_local, $arr_category);
    preg_match_all($pattern_continue_section, $content_local, $arr_section);
    preg_match_all($pattern_continue_serverName, $content_local, $arr_serverName);
    preg_match_all($pattern_continue_superRegion, $content_local, $arr_superRegion);
    preg_match_all($pattern_continue_u, $content_local, $arr_u);
    $url_continue = $arr_continue[1];
    $data_disc = $arr_disc[1];
    $data_category = $arr_category[1];
    $data_section = $arr_section[1];
    $data_serverName = $arr_serverName[1];
    $data_superRegion = $arr_superRegion[1];
    $data_u = $arr_u[1];

    $data_continue = array(
        'disc' => $data_disc,
        'category' => $data_category,
        'section' => $data_section,
        'serverName' => $data_serverName,
        'superRegion' => $data_superRegion,
        'u' => $data_u
    );
    $content_continue = $curl->get_content_post($url_continue, $cookie,$data_continue);
}

/*publish_1*/
if (empty($content_continue)) {
    echo 'continue fail';
} else {
    echo 'continue succeed';
    $pattern_publish_1_url = "/<form name=\"f\" method=\"post\" action=\"(.*)?\" enctype=\"multipart\/form-data\" onsubmit=\'(.*)?\'>/";
    $pattern_publish_1_u = "/<input type=\"hidden\" name=\"u\" value=\"(.*)?\">/";
    $pattern_publish_1_serverName = "/<input type=\"hidden\" name=\"serverName\" value=\"(.*)?\">/";
    $pattern_publish_1_lang = "/<input type=\"hidden\" name=\"lang\" value=\"(.*)?\">/";
    $pattern_publish_1_section = "/<input type=\"hidden\" name=\"section\" value=\"(.*)?\">/";
    $pattern_publish_1_category = "/<input type=\"hidden\" name=\"category\" value=\"(.*)?\">/";
    $pattern_publish_1_disc = "/<input type=\"hidden\" name=\"disc\" value=\"(.*)?\">/";
    $pattern_publish_1_region = "/<input type=\"hidden\" name=\"region\" value=\"(.*)?\">/";
    $pattern_publish_1_affiliate = "/<input type=\"hidden\" name=\"affiliate\" value=\"(.*)?\">/";
    $pattern_publish_1_pid = "/<input type=\"hidden\" name=\"pid\" value=\"(.*)?\">/";
    $pattern_publish_1_nextPage = "/<input type=\"hidden\" name=\"nextPage\" value=\"(.*)?\">/";
    $pattern_publish_1_contactPhone = "/<input type=\"tel\" name=\"contactPhone\" class=\"required mediumInput\" maxlength=\"40\" value=\"(.*)?\">/";
    $pattern_publish_1_socialMediaUrl = "/<input type=\"text\" name=\"socialMediaUrl\" class=\"mediumInput required\" value=\"(.*)?\">/";
    $pattern_publish_1_age = "/<input type=\"number\" name=\"age\" class=\"required smallInput\" value=\"(.*)?\">/";
    $pattern_publish_1_email = "/<input type=\"email\" name=\"email\" class=\"mediumInput\" value=\"(.*)?\" disabled=\"true\">/";
    $pattern_publish_1_allowReplies = "/ <input type=\"radio\" name=\"allowReplies\" value=\"(.*)?\" checked>/";
    $pattern_publish_1_baseMarket = "/<input type=\"checkbox\" name=\"baseMarket\" id=\"baseMarket\" value=\"(.*)?\" data-basePrice=\"1.00\" disabled checked>/";


    preg_match_all($pattern_publish_1_url, $content_continue, $arr_publish_1_url);
    preg_match_all($pattern_publish_1_u, $content_continue, $arr_publish_1_u);
    preg_match_all($pattern_publish_1_serverName, $content_continue, $arr_publish_1_serverName);
    preg_match_all($pattern_publish_1_lang, $content_continue, $arr_publish_1_lang);
    preg_match_all($pattern_publish_1_section, $content_continue, $arr_publish_1_section);
    preg_match_all($pattern_publish_1_category, $content_continue, $arr_publish_1_category);
    preg_match_all($pattern_publish_1_disc, $content_continue, $arr_publish_1_disc);
    preg_match_all($pattern_publish_1_region, $content_continue, $arr_publish_1_region);
    preg_match_all($pattern_publish_1_affiliate, $content_continue, $arr_publish_1_affiliate);
    preg_match_all($pattern_publish_1_pid, $content_continue, $arr_publish_1_pid);
    preg_match_all($pattern_publish_1_nextPage, $content_continue, $arr_publish_1_nextPage);
    preg_match_all($pattern_publish_1_contactPhone, $content_continue, $arr_publish_1_contactPhone);
    preg_match_all($pattern_publish_1_socialMediaUrl, $content_continue, $arr_publish_1_socialMediaUrl);
    preg_match_all($pattern_publish_1_age, $content_continue, $arr_publish_1_age);
    preg_match_all($pattern_publish_1_email, $content_continue, $arr_publish_1_email);
    preg_match_all($pattern_publish_1_allowReplies, $content_continue, $arr_publish_1_allowReplies);
    preg_match_all($pattern_publish_1_baseMarket, $content_continue, $arr_publish_1_baseMarket);

    $url_publish_1 = $arr_publish_1_url[1];
    $data_u = $arr_publish_1_u[1];
    $data_serverName = $arr_publish_1_serverName[1];
    $data_lang = $arr_publish_1_lang[1];
    $data_section = $arr_publish_1_section[1];
    $data_category = $arr_publish_1_category[1];
    $data_disc= $arr_publish_1_disc[1];
    $data_region = $arr_publish_1_region[1];
    $data_affiliate = $arr_publish_1_affiliate[1];
    $data_pid = $arr_publish_1_pid[1];
    $data_nextPage= $arr_publish_1_nextPage[1];
    $data_contactPhone = $arr_publish_1_contactPhone[1];
    $data_socialMediaUrl = $arr_publish_1_socialMediaUrl[1];
    $data_age = $arr_publish_1_age[1];
    $data_email = $arr_publish_1_email[1];
    $data_allowReplies= $arr_publish_1_allowReplies[1];
    $data_baseMarket = $arr_publish_1_baseMarket[1];

    $data_publish_1= array(
        'u' => $data_u,
        'serverName' => $data_serverName,
        'lang' => $data_lang,
        'section' => $data_section,
        'category' => $data_category,
        'disc' => $data_disc,
        'region' => $data_region,
        'affiliate' => $data_affiliate,
        'pid' => $data_pid,
        'nextPage' => $data_nextPage,
        'contactPhone' => $data_contactPhone,
        'socialMediaUrl' => $data_socialMediaUrl,
        'age' => $data_age,
        'email' => $data_email,
        'allowReplies' => $data_allowReplies,
        'baseMarket' => $data_baseMarket,
        'acceptTerms' => true
    );
    $content_publish_1 = $curl->get_content_post($url_publish_1, $cookie,$data_publish_1);
}