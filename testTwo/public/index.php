<?php
namespace myframe;

require '../vendor/autoload.php';
(new App())->run();

//require '../app/StudentController.php';
//$student = new StudentController();
//$student->index();
//------------------------------------------------------------------------------

//$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
//
//$route=[
//    'index'=>'student/index',
//    'student/getOne'=>'student/getOne',
//    'student/update'=>'student/update',
//    'test'=>'student/test'
//
//];
//
//$str = trim($pathInfo,'/');
//
//if (isset($route[$str])){
//    $pathInfo=$route[$str];
//}
//
//$arr =explode('/',$pathInfo);
//
//if (!isset($arr[1])){
//    die('请求信息有误！');
//}
//
//list($controller,$action) = $arr;
//
//define('APP_PATH','../app/');
//define('VIEW_PATH','../views/');
//
//$controller = ucwords($controller).'Controller';
//
//require APP_PATH . $controller . '.php';
//
//
//$obj = new $controller;
//$obj->$action();


