<?php
$url = 'localhost/autopush/respose.php';
$file = __DIR__ .'upload/0.jpg';
$data = array('file'=>new CURLFile($file));
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$content = curl_exec($curl);
curl_close($curl);
print_r($content);