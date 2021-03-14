<?php
//常量的定义
define('PRICE',0.4);
echo PRICE.'</br>';

// -----双色球-------------------
$redArr=range(1,33);
$red=array_rand($redArr,6);
shuffle($red);
echo '红色球： ';
foreach ($red as $key){
    echo $redArr[$key]<10?'0'.$redArr[$key].' ':$redArr[$key].' ';
}
echo '</br>';
$blue = rand(1,16);
echo '蓝色球： ';
    echo $blue<10?'0'.$blue.'</br>':$blue.'</br>';
//-------------------------------金字塔---------------------------------
$i=1;
$h=6;//金字塔行数
while($i<$h){
    $j=1;
    while ($j<($h-$i)){
        echo '&nbsp;';
        $j++;
    }

    $k=1;
    while ($k<=($i*2)-1){
        echo '*';
        $k++;
    }

    $i++;
    echo '</br>';

}

echo '</br>';
//--------------验证码---------------------
$charArr = array_merge(range(0,9),range('A','Z'),range('a','z'));
$start = 0;
$end  = count($charArr)-1;
$codeLen=5; //验证码长度
$code='';
for ($i=$start;$i<$codeLen;$i++){
    $code.=$charArr[rand($start,$end)];
}
echo '验证码：'.$code.'</br>';


$array = array(1, 2, 2, 3);
$array = array_unique($array);
print_r($array);




$sum=0;
for ($i=0;$i<=10;$i++){
    if ($i%2==0){
        $sum=$sum+$i;
    }
}

echo $sum.'------------------';