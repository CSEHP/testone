<?php
//定义图片的位置
include ('waterMark.php');
header('content-type:text/html;charset=utf-8');
$imagePath = './image.jpg';
$waterMarkPath ='./watermark.png';


makeWaterMark($imagePath,$waterMarkPath,'rightDown');
