<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
<?php
//链接数据库 设置字符集
$link = mysqli_connect('127.0.0.1', 'root', 'WAN123', 'test');
if (!$link) {
    die('数据库连接失败' . mysqli_connect_error());
}
mysqli_set_charset($link, 'utf8');

//退出处理
$action = isset($_GET['action']) ? isset($_GET['action']): '';
if($action=='logout'){
    session_start();
    $_SESSION=array();
    setcookie(session_name(),'',time()-1);
    session_destroy();
}


//登录表单处理
if (!empty($_POST)) {

    //处理用户提交的数据
    $uname = isset($_POST['uname']) ? mysqli_real_escape_string($link, trim($_POST['uname'])) : '';
    $upwd = isset($_POST['upwd']) ? mysqli_real_escape_string($link, trim($_POST['upwd'])) : '';
    $code = isset($_POST['code']) ? trim($_POST['code']) : '';
    session_start();
    echo '用户输入验证码：'.$code.'--seesion存的验证码'.$_SESSION['code'];
    if (!$uname || !$upwd) {
        die('用户名密码不能为空');
    }
    //    验证码判空 判错
    if(!$code){
        die('验证码不能为空！');
    }
    session_start();
    if(strtolower($_SESSION['code']) != strtolower($code)){
        die('验证码错误！');
    }
//    判断是否存在该用户
    $selUnameSql="select * from users where uname='$uname'";
    $res = mysqli_query($link, $selUnameSql);
    if (!$res) {
        echo 'sql异常' . $selUnameSql;
        echo '</br>';
        die('异常信息：' . mysqli_error($link));
    }

    $userNameInfo = mysqli_fetch_assoc($res);
    if (!$userNameInfo) {
        die('该用户 不存在');
    }
    $md5Upwd =md5(md5($upwd).$userNameInfo['usalt']);
    echo 'md5 处理后的密码'.$md5Upwd;

    $loginSql = "select * from users where uname='$uname' and  upwd ='$md5Upwd'";
    //执行sql
    $res = mysqli_query($link, $loginSql);
    if (!$res) {
        echo 'sql异常' . $loginSql;
        echo '</br>';
        die('异常信息：' . mysqli_error($link));
    }

    $userInfo = mysqli_fetch_assoc($res);
    if (!$userInfo) {
        die('密码错误');
    }

    //信息存session
    session_start();
    $_SESSION['userInfo'] = array(
        'isLogin'=>1,
        'uid'=>$userInfo['uid'],
        'uname'=>$userInfo['uname']
    );

    header('location:./index.php');

}


?>


<h1>登录系统页面</h1>
<form action="login.php" method="post">
    <div>
        <label for="userName">用户名：</label>
        <input type="text" name="uname" id="userName">
    </div>
    <div>
        <label for="userPwd">密码：</label>
        <input type="password" name="upwd" id="userPwd">
    </div>
    <div>
        <label for="code">验证码</label>
        <input type="text" name="code" id="code">
        <img src="../imageCode/imageCode.php" alt="验证码">
    </div>
    <div>
         <input type="checkbox" value="on" id="remindMe" name="code">
         <label for="remindMe">下次自动登录</label>
     </div>
    <div>
        <input type="submit" value="登录">
    </div>
</form>

</body>
</html>