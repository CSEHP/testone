<?php
$fileInfo = $_FILES['upFile'];
$fileType = substr(strrchr($fileInfo['name'],'.'),1);

if (!empty($fileInfo['name'])){
    if ($fileInfo['error']==0){

        $allowType = ['jpg','png','gif'];
        if (!in_array($fileType,$allowType)){
            exit('您上传的文件类型不符合要求：'.implode('、',$allowType));
        }

        $fileSize = $fileInfo['size'];
        $maxSize = 2*1024*1024;
        if ($fileSize>$maxSize){
            exit('您上传的文件大小超出限制：'.($maxSize/1024/1024).'MB');
        }

        $fileBaseName = md5(uniqid(rand()));
        $filName = $fileBaseName.'.'.$fileType;

        $basePath = './upload';
        $subPath = date('Ymd');
        $filePath = "$basePath/$subPath";
        if (!file_exists($filePath)){
            mkdir($filePath,0777,true);
        }

        $res = move_uploaded_file($fileInfo['tmp_name'],"$filePath/$filName");

        if ($res){
            exit('图片上传成功！');
        }else{
            exit('图片上传失败！');
        }

    }
}else {
    exit('您未选择文件！');
}
