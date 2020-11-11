<?php
$link = mysqli_connect("localhost","root","WAN123","stum");
echo '<pre>';
print_r($link) ;
echo '<hr>';


$sql = 'select * from students';
$arr = mysqli_query($link,$sql);
echo '<pre>';
print_r($arr) ;
echo '<hr>';


while ($res = mysqli_fetch_assoc($arr)){
    print_r($res);
}
