<?php
header("Content-type:text/html;charset=UTF-8");
echo "202015090046 万胜杰";
echo "<br>";
$city = "cityName";
$$city = "beijing";
echo $$city;

echo "<br>";
/*1. 若用户在一个全场8折的网站中购买了2斤香蕉、1斤苹果和3斤橘子，
它们的价格分别为7.99元/斤、6.89元/斤、3.99元/斤，使用PHP程序计算此用户实际需支付的费用。
通过PHP中提供的变量与常量、算术运算符以及赋值运算符等相关知识来实现PHP中商品价格计算。
*/
define("DISCOUNT", 0.8); //折扣
define("BANANA_PRICE", 7.99); //香蕉单价
define("APPLE_PRICE", 6.89); //苹果单价
define("ORANGE_PRICE", 3.99); //橘子单价

$bananaWeight = 2; //香蕉重量
$appleWeight = 1; //苹果重量
$orangeWeight = 3; // 橘子重量

$sumMoney = (($bananaWeight * BANANA_PRICE) + ($appleWeight * APPLE_PRICE) + ($orangeWeight * ORANGE_PRICE)) * DISCOUNT;  //钱数

echo '共花费：' . $sumMoney;
echo "<br>";
echo "<hr>";
/*
 * 2. 金字塔可以说是世界建筑的奇迹之一，
 * 其形状呈三角形，那么如何使用程序代码来打印如下图所示的金字塔图形呢？
 * 通过PHP中提供的while循环语句和递增递减运算符来实现这个功能，
 * 从而根据条件判断使程序代码按照一定规律的输出。
 * */
$i = 1;
while ($i < 6) {
    $j = 1;
    while ($j <= (6 - $i)) {
        echo "&nbsp";
        $j++;
    }
    $k = 1;
    while ($k <= (($i * 2) - 1)) {
        echo "*";
        $k++;
    }
    $i++;
    echo "<br>";
}
echo "<hr>";

// -------------双色球
$redArr = range(1, 33); //生成1-33的数组$redArr
$red = array_rand($redArr, 6); //在$redArr数组里随机选取六个数字的下标赋值给$red
shuffle($red); //将$red里的数据打乱

echo '<br>';
echo '红色球：';
foreach ($red as $key) {  //遍历$red
    if ($redArr[$key] < 10) {
        echo '0' . "$redArr[$key] &nbsp;";  //将遍历的下标赋值给$redArr 取出数据 若数小于10 前面加0
    } else {
        echo "$redArr[$key] &nbsp;";
    }
}

echo "<br>";
$blue = rand(1, 16);  //随机生成一个1-16范围内的数
if ($blue < 10) {
    echo "蓝色球：0$blue";  //若数小于10 前面加0   三目运算也可以
} else {
    echo "蓝色球：$blue";
}

echo "<br>";




