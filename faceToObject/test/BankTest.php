<?php
header("Content-type:text/html;charset=utf-8");
require_once "../interface/Bank.class.php";


$bank1 = new Bank("张三","1000","******");
$bank1->pay();