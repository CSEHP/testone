<?php
$charArr= array_merge(range(0,1),range('A','Z'),range('a','z'));
$start=0;
$end = count($charArr)-1;
$codeLen=6;
$code='';
for ($i=0;$i<$codeLen;$i++){
    $code.=$charArr[rand($start,$end)];
}

$imgWidth = 500;
$imgHeight = 210;
$img = imagecreatetruecolor($imgWidth,$imgHeight);
$imgColor=imagecolorallocate($img,55,55,55);
imagefill($img,0,0,$imgColor);

//边框
$BKColor = imagecolorallocate($img,255,0,0);
imagerectangle($img,0,0,$imgWidth-1,$imgHeight-1,$BKColor);

//随机像素点
$pixTotal =500;
for ($i=0;$i<$pixTotal;$i++){
    $pixColor =imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
    imagesetpixel($img,rand(0,$imgWidth-1),rand(0,$imgHeight-1),$pixColor);
}

//随机线条数量
$lineTotal =10;
for ($i=0;$i<$lineTotal;$i++){
    $lineColor =imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
    imageline($img,rand(0,$imgWidth-1),rand(0,$imgHeight-1),rand(0,$imgWidth-1),rand(0,$imgHeight-1),$lineColor);
}

//将文字写在画布上
for ($i=1;$i<=$codeLen;$i++){
    $codeColor =imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
    imagettftext($img,30,0,rand(($imgWidth/$codeLen)*($i-1),($imgWidth/$codeLen)*$i),rand(90,160),$codeColor,
                __DIR__.'/font.ttf',$code[$i-1]);
}

// 输出到浏览器后销毁
header('content-type:image/png');
imagepng($img);
imagedestroy($img);