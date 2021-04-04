<?php

function imageAddWatermark($imagePath,$watermarkPath){

    $formFunction = [
        'image/jpeg'=>'imagecreatefromjpeg',
        'image/png'=>'imagecreatefrompng',
        'image/gif'=>'imagecreatefromgif'
    ];

    $toFunction =[
        'image/jpeg'=>'imagejpeg',
        'image/png'=>'imagepng',
        'image/gif'=>'imagegif'
    ];

//    目标图片
    $imageInfo = getimagesize($imagePath);
    list($imageWidth,$imageHeight)= $imageInfo;
    $imageMine = $imageInfo['mime'];
//    水印图片

    $WaterImageInfo = getimagesize($watermarkPath);
    list($WaterImageWidth,$WaterImageHeight)= $WaterImageInfo;
    $WaterImageMine = $WaterImageInfo['mime'];

//    根据目标图片类型创建画布
    $image = $formFunction[$imageMine]($imagePath);
    $waterImage = $formFunction[$WaterImageMine]($watermarkPath);


    $dstX = $imageWidth-$WaterImageWidth;
    $dstY = $imageHeight-$WaterImageHeight;
    //将水印图片复制到目标图片上面
    imagecopy($image,$waterImage,$dstX,$dstY,0,0,$WaterImageWidth,$WaterImageHeight);

//    将添加了水印的图片输出到浏览器
    header("content-type:$imageMine");
    $toFunction[$imageMine]($image);// 输出目标格式图片

//    销毁两个画布
    imagedestroy($image);
    imagedestroy($waterImage);
}





