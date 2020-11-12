<?php
//封装链接数据库函数
function dbConnect($host,$user,$pwd,$dbName,$charset='utf8'){
$link = mysqli_connect($host,$user,$pwd);
if (!$link){
    exit('数据库连接失败！'.mysqli_connect_error());
}
mysqli_select_db($link,$dbName);
mysqli_set_charset($link,$charset);
return $link;
}
//封装执行sql函数
function dbQuery($link,$sql){
    $res = mysqli_query($link,$sql);
    if (!$res){
        echo 'sql语句执行失败!';
        echo '<br>';
        echo 'sql语句-->'.$sql;
        echo '<br>';
        echo '错误信息：'.mysqli_error($link);
        echo '<br>';
        exit;
    }
    return $res;
}
//封装查询一条记录 函数
function dbFetchOne($link,$sql){
    $res = dbQuery($link,$sql);
    $arr = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    return $arr;
}
//封装查询所有记录 函数
function dbFetchAll($link,$sql){
    $res = dbQuery($link,$sql);
    $arr = mysqli_fetch_all($res,MYSQLI_ASSOC);
    mysqli_free_result($res);
    return $arr;
}