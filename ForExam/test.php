<?php
$fileName = 'test.jsp';
echo substr(strrchr($fileName,'.'),1).'<br>';
echo md5($fileName).'>>当前的毫秒值：'.microtime().'<br>';
$ms = microtime();
echo md5(md5($fileName).$ms).'<br>';
echo strtoupper(trim($fileName));


//分页原理
//    定义最小页码
//    定义每页的记录条数
//    查出所有记录数 除以 每页条数 向上取整 ceil（） 拿到最大页码值
//    （当前页-最小页码）*每页的记录数目 取得为偏移量 $offset

