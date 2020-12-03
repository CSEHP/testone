<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
//引入函数包 连接数据库
require  './utils/dbFunction.php';
$link = dbConnect('127.0.0.1','root','WAN123','test');

//判断传来的id 是否存在
$id= isset($_GET['id']) ? intval($_GET['id']) :'';
if(!$id){
    echo '<a href="page.php">返回列表页</a>';
    echo '<br>';
    die('请传递有效的信息！');
}

//查询要修改的 员工信息
$empSql="select * from emp_info where emp_id =$id";
$empInfo= dbFetchOne($link,$empSql);



//准备 更新 需要的 信息
if(empty($_POST)){
    $deptSql = 'select * from dept_info';
    $deptArr = dbFetchAll($link,$deptSql);
}else{
    $name = isset($_POST['emp_name']) ? mysqli_real_escape_string($link,trim($_POST['emp_name'])):'';
    $dept = isset($_POST['emp_dept_id']) ? mysqli_real_escape_string($link,trim($_POST['emp_dept_id'])):'';
    $birth = isset($_POST['emp_birth']) ? mysqli_real_escape_string($link,trim($_POST['emp_birth'])):'';
    $entry = isset($_POST['emp_entry']) ? mysqli_real_escape_string($link,trim($_POST['emp_entry'])):'';

    if(!($name && $dept && $birth && $entry)){
        echo '<a href="editEmp.php"> 返回编辑页面</a>';
        echo '<br>';
        die('massage ：员工信息不能为空');
    } else{
        $updateSql = "update emp_info set emp_name='$name',emp_dept_id=$dept,emp_birth='$birth',emp_entry='$entry' where emp_id = $id";
        $res = dbQuery($link,$updateSql);
        echo '--------------?>'.$res;
        header('location: ./page.php');
        echo '<br>';
        die('员工信息修改成功');
    }
}
?>

<div>
    <div>
        <h3>编辑员工</h3>
    </div>
    <div>
        <form method="post" action="editEmp.php?id=<?= $empInfo['emp_id']?>">
            <div>
                <label for="emp_name">姓名</label>
                <input type="text" name="emp_name" id="emp_name" value=<?= $empInfo['emp_name']?>>
            </div>

            <div>
                <label for="emp_dept_id">部门</label>
                <select name="emp_dept_id" id="emp_dept_id">
                    <option value="">--请选择部门--</option>
                    <?php foreach ($deptArr as $item){?>
                        <option value="<?= $item['dept_id']?>"   <?=$item['dept_id'] ==$empInfo['emp_dept_id'] ? 'selected':''  ?>  >
                            <?= $item['dept_name']?>
                        </option>
                    <?php }?>
                </select>
            </div>

            <div>
                <label for="emp_birth">出生日期</label>
                <input type="date" name="emp_birth" id="emp_birth" value=<?= $empInfo['emp_birth']?>>
            </div>

            <div>
                <label for="emp_entry">入职日期</label>
                <input type="date" name="emp_entry" id="emp_entry" value=<?= $empInfo['emp_entry']?>>
            </div>

            <div>
                <input type="submit" value="更新">
            </div>

        </form>
    </div>
</div>
</body>
</html>