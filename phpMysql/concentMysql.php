<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>phpConnectMysql</title>
</head>
<body>
<?php
//引入函数文件
require_once './utils/dbFunction.php';
//链接数据库
$link = dbConnect('127.0.0.1','root','WAN123','stum');
//拿到关键字
$keyWords = isset($_GET['keyWords']) ?
    mysqli_real_escape_string($link,$_GET['keyWords']): '';

$str = '?'.http_build_query($_GET);
unset($_GET['page']);
echo $str;
echo '<br>';


//分页
$countSql = "select count(*) as count  from students where sname like '% $keyWords%'";
$countArr = dbFetchOne($link, $countSql);

$count = $countArr['count'];
$minPage = 1;
$page = isset($_GET['page']) ? intval($_GET['page']) : $minPage;
$pageSize = 3;
$maxPage = ceil($count / $pageSize);


if ($page > $maxPage) {
    $page = $maxPage;
}

if ($page < $minPage) {
    $page = $minPage;
}
$offset = ($page - $minPage) * $pageSize;

$limit = " limit $offset,$pageSize";
//将条件拼接到sql上
//$sql = 'select * from students' . $limit;
//echo '--------------' . $sql;



//将关键字写道sql中
$where = '';
if ($keyWords){
    $where = " where sname like '%$keyWords%' ";
}
//拼接sql
$baseSql = 'select * from students';
$sql = $baseSql.$where.$limit;
echo '=--------->>>>'.$sql;
//执行sql
$res = dbQuery($link, $sql);
//查询所有的记录
$arr = dbFetchAll($link,$sql);

//关闭结果集和链接 释放资源
mysqli_close($link);
?>

<table border="1" cellspacing="0">
    <h2> 学生信息表</h2>
    <form method="get" action="concentMysql.php?keyWords=<?= $keyWords?>&page=<?= $page?>">

        <input type="text" name="keyWords">
        <input type="submit" value="搜索">
    </form>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>性别</th>
        <th>学院</th>
        <th>地址</th>
    </tr>



    <?php foreach ($arr as $value){ ?>

    <tr>
        <td><?= $value['sno'] ?></td>
        <td><?= $value['sname'] ?></td>
        <td><?= $value['sex'] ?></td>
        <td><?= $value['sdept'] ?></td>
        <td><?= $value['saddress'] ?></td>
    </tr>

    <?php } ?>
  </table>


<?php if ($page == $minPage) { ?>
    <span>首页</span>
    <span>上一页</span>
<?php } else { ?>
    <a href="concentMysql.php?keyWords=<?= $keyWords ?>&page=<?= $minPage ?>">首页</a>
    <a href="concentMysql.php?keyWords=<?= $keyWords ?>&page=<?= $page - 1 ?>">上一页</a>
<?php } ?>


<?php if ($page == $maxPage) { ?>
    <span>下一页</span>
    <span>尾页</span>
<?php } else { ?>
    <a href="concentMysql.php?keyWords=<?= $keyWords ?>&page=<?= $page + 1 ?>">下一页</a>
    <a href="concentMysql.php?keyWords=<?= $keyWords ?>&page=<?= $maxPage ?>">尾页</a>

<?php } ?>


</body>
</html>