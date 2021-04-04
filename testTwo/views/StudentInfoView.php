<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h2>编辑学生信息</h2>
<form action="update" method="post">
    <table>
        <tr>
            <td><input type="hidden" name="sno" value="<?= $data['sno'] ?>"></td>
        </tr>
        <tr>
            <td>姓名：</td>
            <td> <input name="sname" value="<?= $data['sname']?>"/></td>
        </tr>
        <tr>
            <td>性别：</td>
            <td> <input name="sex" value="<?= $data['sex']?>"/></td>
        </tr>
    </table>
    <input type="submit" value="确定修改">

</form>

</body>
</html>
