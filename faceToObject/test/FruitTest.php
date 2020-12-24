<?php
header("Content-type:text/html;charset=utf-8");
require_once "../bean/Apple.class.php";
$redApple = new Apple("红富士","red","2.8/斤","0.8kg");
$redApple->show_apple();
