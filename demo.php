<?php


$student = [
    $array = [
        'id' => '202015090046',
        'name' => '万胜杰',
        'onlineTime' => 12,
        'offlineTime' => 25
    ],
    $array = [
        'id' => '202015090043',
        'name' => '王朝纲',
        'onlineTime' => 30,
        'offlineTime' => 25
    ],
    $array = [
        'id' => '202015090055',
        'name' => '王鹏',
        'onlineTime' => 25,
        'offlineTime' => 63
    ]
];

echo "<pre>";
print_r($student);

$arr = range(10,15);
echo "<pre>";
print_r($arr);

$str='he,ll,o, w,or,d';
$arr1=explode(',',$str);
echo "<pre>";
print_r($arr1);
echo 'arr1 数组内元素个数为:'.count($arr1,1)."<br>";
echo current($arr1)."<br>";
echo next($arr1)."<br>";
echo prev($arr1)."<br>";

echo "<pre>";
print_r(array_reverse($arr));



