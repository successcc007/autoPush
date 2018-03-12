<?php

/**
 * Created by PhpStorm.
 * User: congchao
 * Date: 2018-03-12
 * Time: 15:23
 */
class imgAddText
{
    function AddText($bigImgPath, $text, $savePath)
    {
        // $text水印文字
        //  $bigImgPath = 'backgroud.png';
        list($bgWidth, $bgHight, $bgType) = getimagesize($bigImgPath);
        $img = imagecreatefromstring(file_get_contents($bigImgPath));
        $font = './upload/simsun.ttc';//字体
        $black = imagecolorallocate($img, 0x00, 0x00, 0x00);//字体颜色 RGB
        $fontSize = 20;   //字体大小
        $circleSize = 0; //旋转角度
        $left = strlen($text) + 20;      //左边距
        $top = $bgHight - 40;       //顶边距

        imagefttext($img, $fontSize, $circleSize, $left, $top, $black, $font, $text);
        switch ($bgType) {
            case 1: //gif
                header('Content-Type:image/gif');
                imagegif($img, $savePath);
                break;
            case 2: //jpg
                header('Content-Type:image/jpeg');
                imagejpeg($img, $savePath);
                break;
            case 3: //jpg
                header('Content-Type:image/png');
                imagepng($img, $savePath);
                break;
            default:
                break;
        }
        imagedestroy($img);
    }

    function AddImg($bigImgPath, $qCodePath, $savePath)
    {
        //$bigImgPath = 'backgroud.png';
        //$qCodePath = 'qcode.png';
        $bigImg = imagecreatefromstring(file_get_contents($bigImgPath));
        $qCodeImg = imagecreatefromstring(file_get_contents($qCodePath));
        list($qCodeWidth, $qCodeHight, $qCodeType) = getimagesize($qCodePath);
// imagecopymerge使用注解,200
//imagecopymerge($bigImg, $qCodeImg, 背景图x坐标, 背景图y坐标, 水印图x坐标, 水印图y坐标, 水印图宽$qCodeWidth, 水印图高$qCodeHight, 水印图透明度100);
        imagecopymerge($bigImg, $qCodeImg, 20, 30, 0, 0, $qCodeWidth/2, $qCodeHight/2, 100);
        list($bigWidth, $bigHight, $bigType) = getimagesize($bigImgPath);
        switch ($bigType) {
            case 1: //gif
                header('Content-Type:image/gif');
                imagegif($bigImg, $savePath);
                break;
            case 2: //jpg
                header('Content-Type:image/jpg');
                imagejpeg($bigImg, $savePath);
                break;
            case 3: //jpg
                header('Content-Type:image/png');
                imagepng($bigImg, $savePath);
                break;
            default:
                # code...
                break;
        }
        imagedestroy($bigImg);
        imagedestroy($qCodeImg);
    }
}