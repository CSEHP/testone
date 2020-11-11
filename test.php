<?php
//定义数据
$student = [
    $array = [
        'id' => '202015090046',
        'name' => '万胜杰',
        'class'=>'软工一班',
        'onlineTime' => 1,
        'offlineTime' => 2
    ],
    $array = [
        'id' => '202015090043',
        'name' => '王朝纲',
        'class'=>'软工一班',
        'onlineTime' => 3,
        'offlineTime' => 4
    ],
    $array = [
        'id' => '202015090055',
        'name' => '王鹏',
        'class'=>'软工一班',
        'onlineTime' => 5,
        'offlineTime' => 6
    ]
];

//写表格
echo '<table border="1px"><tr align="center"><th colspan="6">学习时长统计</th></tr>
 <tr align="center">
        <td>学号</td>
        <td>姓名</td>
        <td>班级</td>
        <td>在线学习时长(h)</td>
        <td>线下学习时长(h)</td>
        <td>总学习时长(h)</td>
 </tr>';
//将数据遍历到表格里面
$sumLineTime=0;
$sumOffTime=0;
$sum=0;
$sumTime=0;

foreach ($student as $value){
    $sum=$value[onlineTime]+$value[offlineTime];
    echo "<tr align='center'>
        <td>$value[id]</td>
        <td>$value[name]</td>
        <td>$value[class]</td>
        <td>$value[onlineTime]</td>
        <td>$value[offlineTime]</td>
        <td>$sum</td>
 </tr>";


    $sumLineTime+=$value[onlineTime];
    $sumOffTime+=$value[offlineTime];
    $sumTime=$sumLineTime+$sumOffTime;
//    $sum=0;
}


echo "<tr align='center'><th colspan='6'>总时长$sumTime</th></tr><table>";