<?php

function makeWaterMark($imagePath, $waterMarkPath,$place='rightDown')
{
    $fromFunction = [
        'image/jpeg' => 'imagecreatefromjpeg',
        'image/png' => 'imagecreatefrompng',
        'image/gif' => 'imagecreatefromgif'
    ];

    $toFunction = [
        'image/jpeg' => 'imagejpeg',
        'image/png' => 'imagepng',
        'image/gif' => 'imagegif',
    ];

//获取图片信息
    $imageInfo = getimagesize($imagePath);
    list($imageWidth, $imageHeight) = $imageInfo; // 按数组顺序将值赋给list中的width height 两个变量
    $imageMime = $imageInfo['mime'];

    $waterInfo = getimagesize($waterMarkPath);
    list($waterWidth, $waterHeight) = $waterInfo;
    $waterMine = $waterInfo['mime'];

// 根据图片创建画布
    $image = $fromFunction[$imageMime]($imagePath);
    $waterImage = $fromFunction[$waterMine]($waterMarkPath);

//给目标图片加水印
    $srcX = 0;
    $srcY = 0;
    if($place=='rightDown'){
        $srcX = $imageWidth - $waterWidth;
        $srcY = $imageHeight - $waterHeight;
    }else if($place=='rightUp'){
        $srcX = $imageWidth - $waterWidth;
        $srcY = 0;
    }else if($place=='leftUp'){
        $srcX =0;
        $srcY =0;
    }else if($place=='leftDown'){
        $srcX = 0;
        $srcY = $imageHeight - $waterHeight;
    }else{
        exit('您输入的水印位置不存在！！');
    }


    imagecopy($image, $waterImage, $srcX, $srcY,
        0, 0, $waterWidth, $waterHeight);

    header("content-type:$imageMime");
    $toFunction[$imageMime]($image);

//销毁画布
    imagedestroy($image);
    imagedestroy($waterImage);
}
