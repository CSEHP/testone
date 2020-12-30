<?php
$fileInfo = $_FILES['upFile'];
echo '<pre>';
print_r($fileInfo);
$fileType = substr(strrchr($fileInfo['name'],'.'),1);
echo $fileType.'<br>';

if (!empty($fileInfo['name'])){
    if ($fileInfo['error']==0){
//        允许上传文件类型
        $allowType = ['gif','jpg','png','jpeg'];
        if (!in_array($fileType,$allowType)){
            die('您上传的文件类型不符合要要求，请上传符合要求的文件类型：'.implode('、',$allowType));
        }
//        允许上传文件大小
        $fileSize=$fileInfo['size'];
        $maxSize=1*1024*1024;
        if ($maxSize<$fileSize){
            die('文件大小超出限制，允许的文件大小是：'.($maxSize/1024/1024).'MB');
        }
//        对于满足条件的文件生成新的文件名
        $fileBaseName = md5(uniqid(rand()));
        echo 'md5 加密后的文件名：'.$fileBaseName.'<br>';
        $fileName = $fileBaseName.'.'.$fileType;
        echo '新的文件名：'.$fileName.'<br>';

//        存放的文件路径 存放到每天生成的一个文件夹中
        $basePath ='./upload';
        $subPath = date('Ymd');
        $filePath="$basePath/$subPath";
        echo '文件路径：'.$filePath.'<br>';

        if (!file_exists($filePath)){
            mkdir($filePath,0777,true);
        }

//        将文件复制到文件中
        $res = move_uploaded_file($fileInfo['tmp_name'],"$filePath/$fileName");
        if ($res){
            die('文件上传成功');
        }else{
            die('文件上传失败');
        }

    }
}else{
    die('您未选者图片');
}