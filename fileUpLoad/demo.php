<?php
header("content-type:text/html; charset=utf-8");

$fileInfo = $_FILES['upFile'];   //文件信息
$fileType = substr(strrchr($fileInfo['name'],'.'),1); //截取文件后缀名

if(!empty($fileInfo['name'])){
   if($fileInfo['error']==0){

//       给定允许上传的文件类型
       $allowType = ['jpg','gif','png'];   //给定能上传的文件类型
       if (!in_array($fileType,$allowType)){   //判断文件类型是否 符合要求
           exit('系统只能上传图片格式文件'.implode('、',$allowType));  // 提示能够上传的文件类型
       }

//       限制文件大小
       $maxSize = 2 * 1024 * 1024;  //限制上传文件的大小
       $fileSize = $fileInfo['size'];   //获取文件的大小
       if ($fileSize>$maxSize){    // 判断文件 大小是否合格
           exit('文件大小超过限制'.($maxSize/1024/1024).'MB');
       }

//       给文件重命名
      $fileBaseNme = md5(uniqid(rand()));   //随机生成一个文件名 并进行md5加密
      $fileName= $fileBaseNme.'.'.$fileType;  // 将文件名和后缀拼接

//      根据日期创建上传文件夹
      date_default_timezone_set('PRC');  //设置时区
      $basePath = './upload';  //创建一个文件夹用来存放所有的上传文件
      $subPath = date('Ymd');  // 根据日期创建 当天文件夹
      $path = "$basePath/$subPath";     //在upload 文件夹下 创建子文件夹
      if(!file_exists($path)){   //判断文件夹是否存在
         mkdir($path,0777,true);   //不存在就创建文件夹
      }

   $res = move_uploaded_file($fileInfo['tmp_name'],"$path/$fileName");   // 将文件 移动到指定的文件夹
      if($res){    //判断文件是否上传成功
          exit('图片上传成功！');
      }else {
          exit('图片上传失败！');
      }
   }
}else{
    exit('您未选择图片！');
}

