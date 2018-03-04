<?php
define('FORM_BOUNDARY', uniqid('----WebKitFormBoundary'));
define('FORM_HYPHENS', '--');
define('FORM_EOL', "\r\n");
define('FORM_IMG_FIELD_NAME', 'img[]');
class imgAndText
{
    /**
     * 拼接文本类型的表单项
     * @param string $value 表单项的域值
     * @param string $key 表单项的域名
     */
    function text_form_data_splice($value, $key)
    {
        global $post_data;
        $post_data .= FORM_HYPHENS . FORM_BOUNDARY . FORM_EOL
            . "Content-Disposition: form-data; name=\"$key\""
            . FORM_EOL . FORM_EOL
            . $value . FORM_EOL;
    }

    /**
     * 拼接上传图片类型的表单项
     * @param string $value 图片在本地的路径
     * @param string $key 图片名称
     */
    function image_form_data_splice($value, $key)
    {
        global $post_data;

        $image_type = exif_imagetype($value);
        if ($image_type === false) {
            return;
        }
        $mime_type = image_type_to_mime_type($image_type);
        $post_data .= FORM_HYPHENS . FORM_BOUNDARY . FORM_EOL
            . "Content-Disposition: form-data; name=\"" . FORM_IMG_FIELD_NAME
            . "\"; filename=\"$key\"" . FORM_EOL
            . "Content-Type: $mime_type" . FORM_EOL . FORM_EOL
            . file_get_contents($value) . FORM_EOL;
    }

    function curl_post($url, array $header, $data)
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $data,
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $resp = curl_exec($ch);
        if (curl_errno($ch)) {
            $ret = [
                'code' => -1,
                'resp' => curl_error($ch),
            ];
        } else {
            $ret = [
                'code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
                'resp' => $resp,
            ];
        }
        curl_close($ch);

        return $ret;
    }

}

/*
 * 要POST的文本数据和本地图片
 */
$text_data = [
    'username' => 'Tom',
    'password' => '123456',
];
$img_data = [
    '0.jpg' => '/upload/0.jpg',
    '1.jpg' => '/upload/1.jpg',
];

$url = 'respose.php'; // 服务器URL，根据实际情况进行修改
$req_headers = [
    'Content-Type: multipart/form-data; boundary=' . FORM_BOUNDARY,
];
$post_data = '';

array_walk($text_data, 'text_form_data_splice');
array_walk($img_data, 'image_form_data_splice');
if (!empty($post_data)) {
    $post_data .= FORM_HYPHENS . FORM_BOUNDARY . FORM_HYPHENS;
}

$result = curl_post($url, $req_headers, $post_data);
var_dump($result);