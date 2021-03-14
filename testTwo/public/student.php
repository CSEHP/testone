<?php
//require '../app/StudentController.php';
//$student = new StudentController();
//$student->index();
            echo '进入到方法';
            echo '<hr>';
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
            print_r('-----'.$_SERVER['REDIRECT_PATH_INFO']);
            echo '<hr>';
            echo $pathInfo.'-------';
            echo '<hr>';
print_r($pathInfo);
            echo '<hr>';
$str = trim($pathInfo,'/');
            echo $str;
            echo '<hr>';
$arr = explode('/',trim($pathInfo,'/'));
            print_r($arr);
            echo '<hr>';
if (!isset($arr[1])){
    die('请求信息有误！');
}

list($controller,$action) = $arr;
define('APP_PATH','../app/');
define('VIEW_PATH','../views/');
$controller = ucwords($controller).'Controller';
require APP_PATH.$controller.'.php';
$obj = new $controller;
$obj->$action;
