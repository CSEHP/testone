<?php

//生成验证码
$codeLen = 5;
$charArr = array_merge(range(0,9),range('A','Z'),range('a','z'));

$start = 0;
$end = count($charArr)-1;

$code = '';
for($i=0;$i<$codeLen;$i++){
    $code .= $charArr[rand($start,$end)];
}
session_start();
$_SESSION['code'] =$code;

//定义一块画布 并 给画布填充背景色
$imageWidth = 200;
$imageHeight =60;
$image = imagecreatetruecolor($imageWidth,$imageHeight);
$imageColor = imagecolorallocate($image,26,26,26);
imagefill($image,0,0,$imageColor);


//给画布 一个红色边框
$rectangleColor = imagecolorallocate($image,255,0,0);
imagerectangle($image,0,0,$imageWidth-1,$imageHeight-1,$rectangleColor);

// 生成 200个随机 像素点
$pixelTotal = 200;
for($i=0;$i<=$pixelTotal;$i++){
    $pixelColor =imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
    imagesetpixel($image,rand(0,$imageWidth-1),rand(0,$imageHeight-1),$pixelColor);
}

// 生成随机颜色 的 10 条 线条
$lineTotal=10;
for($i=0;$i<$lineTotal;$i++){
    $lineColor =imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
    imageline($image,rand(0,$imageWidth-1),rand(0,$imageHeight-1),rand(0,$imageWidth-1),rand(0,$imageHeight-1),$lineColor);
}

//将文字 写到画布上面
for($i=1;$i<=$codeLen;$i++){
    $codeColor = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
    imagettftext($image,30,0, rand(($imageWidth/$codeLen)*($i-1),($imageWidth/$codeLen)*($i)), rand(40,50),
        $codeColor, __DIR__ . '/font.ttf', $code[$i-1]);
}


//输出到浏览器
header('content-type:image/png');
imagepng($image);
imagedestroy($image);
