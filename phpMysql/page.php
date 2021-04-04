<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
//设置响应头 引入封装函数
//header("content-type:text/html;charset=utf-8");
require_once './utils/dbFunction.php';

//连接数据库
$link = dbConnect("127.0.0.1", "root", "WAN123", "test");

//分页
$countSql = 'select count(*) as count  from emp_info';
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
$sql = 'select * from emp_info e left join dept_info d on e.emp_dept_id=d.dept_id' . $limit;
echo '--------------' . $sql;

//查询全部的数据
$arr = dbFetchAll($link, $sql);

//关闭数据库链接
mysqli_close($link);
?>

<table border="1" cellspacing="0">
    <h2>员工信息表</h2>
    <h3><a href="addEmp.php"> 添加员工</a></h3>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>部门</th>
        <th>出生日期</th>
        <th>入职日期</th>
        <th>操作</th>
    </tr>
    <?php foreach ($arr as $item) { ?>

        <tr>
            <td><?= $item['emp_id'] ?></td>
            <td><?= $item['emp_name'] ?></td>
            <td><?= $item['dept_name'] ?></td>
            <td><?= $item['emp_birth'] ?></td>
            <td><?= $item['emp_entry'] ?></td>
            <td>
                <a href="editEmp.php?id=<?=$item['emp_id']?>">编辑</a>  ||
                <a href="deleteEmp.php?id=<?=$item['emp_id']?>">删除</a>
            </td>
        </tr>

    <?php } ?>
</table>


<?php if ($page == $minPage) { ?>
    <span>首页</span>
    <span>上一页</span>
<?php } else { ?>
    <a href="page.php?page=<?= $minPage ?>">首页</a>
    <a href="page.php?page=<?= $page -1 ?>">上一页</a>
<?php } ?>


<?php if ($page == $maxPage) { ?>
    <span>下一页</span>
    <span>尾页</span>
<?php } else { ?>
    <a href="page.php?page=<?= $page +1  ?>">下一页</a>
    <a href="page.php?page=<?= $maxPage ?>">尾页</a>

<?php } ?>

</body>
</html>