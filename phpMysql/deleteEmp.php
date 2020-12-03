<?php

header("content-type:text/html;charset=utf-8");
require_once './utils/dbFunction.php';

$id= isset($_GET['id']) ? intval($_GET['id']) :'';

if(!$id){
    die('请传递有效的信息！');
}

$link = dbConnect('127.0.0.1','root','WAN123','test');

$empSql="select * from emp_info where emp_id =$id";

$empInfo= dbFetchOne($link,$empSql);
if(!$empInfo){
    die('员工信息不存在！');
}
$delSql = "delete from emp_info where emp_id=$id";
dbQuery($link,$delSql);


header('location:./page.php');