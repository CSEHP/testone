<?php
//引入函数文件
require_once './utils/dbFunction.php';
//链接数据库
$link = dbConnect
('127.0.0.1','root','WAN123','stum');
//拿到关键字
$keyWords = isset($_GET['keyWords']) ?
    mysqli_real_escape_string($link,$_GET['keyWords']): '';
//将关键字写道sql中
$where = '';
if ($keyWords){
    $where = " where sname like '%$keyWords%' ";
}
//拼接sql
$baseSql = 'select * from students';
$sql = $baseSql.$where;
//执行sql
$res = dbQuery($link, $sql);
//查询所有的记录
$arr = dbFetchAll($link,$sql);

echo '
<table border="1">
<h2> 学生信息表</h2>
<form method="get" action="concentMysql.php">
    <input type="text" name="keyWords">
    <input type="submit" value="搜索">
</form>
    <tr>
        <th>姓名</th>
        <th>性别</th>
        <th>学院</th>
        <th>地址</th>    
    </tr>
';
foreach ($arr as $value){
        echo "
            <tr>
                <td>$value[sname]</td>
                <td>$value[sex]</td>
                <td>$value[sdept]</td>
                <td>$value[saddress]</td>
            </tr>
        ";
}
echo '</table>';

//关闭结果集和链接 释放资源
mysqli_close($link);