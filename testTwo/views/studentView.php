<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h2>学生信息列表</h2>
<table>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>性别</th>
        <th>编辑</th>
    </tr>
    <?php foreach ($data as $item) {?>
        <tr>
            <td><?php echo $item['sno']?></td>
            <td><?php echo $item['sname']?></td>
            <td><?php echo $item['sex']?></td>
            <td><a href="student/getOne?sno=<?= $item['sno'] ?>">编辑</a></td>
        </tr>
    <?php }?>
</table>
</body>
</html>
