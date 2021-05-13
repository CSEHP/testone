<?php
/*
 * @Author: your name
 * @Date: 2021-04-12 23:30:46
 * @LastEditTime: 2021-04-12 23:30:46
 * @LastEditors: your name
 * @Description: In User Settings Edit
 * @FilePath: /myframe/public/index.php
 */
namespace myframe;

require '../vendor/autoload.php';

define('VIEW_PATH', '../resources/views/');
App::getInstance()->run()->send();
