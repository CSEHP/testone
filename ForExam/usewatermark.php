<?php
require_once './watermark.php';
header("content-type:text/html;charset=utf-8");

$imagePath= './image.jpg';
$WaterImagePath= './watermark.png';
//print_r(getimagesize($imagePath))  ;


imageAddWatermark($imagePath,$WaterImagePath);