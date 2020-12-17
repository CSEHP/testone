<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>
</head>
<body>
<?php
session_start();
$isLogin = false;
if(isset($_SESSION['userInfo']['uname']) && $_SESSION['userInfo']['isLogin']=='1'){
    $isLogin=true;
}

if(!$isLogin){
    die('未登录');
    header('location:./login.php');
}

?>


<h1>欢迎 : <?=$_SESSION['userInfo']['uname'] ?> </h1>
<a href="login.php?action=logout">退出</a>
</body>
</html>