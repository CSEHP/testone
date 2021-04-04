<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

require  './utils/dbFunction.php';
$link = dbConnect('127.0.0.1','root','WAN123','test');

//if(empty($_POST)){
//    $deptSql = 'select * from dept_info';
//    $deptArr = dbFetchAll($link,$deptSql);
//}else{
//    $name = isset($_POST['emp_name']) ? mysqli_real_escape_string($link,$_POST['emp_name']):'';
//    $dept = isset($_POST['emp_dept_id']) ? mysqli_real_escape_string($link,$_POST['emp_dept_id']):'';
//    $birth = isset($_POST['emp_birth']) ? mysqli_real_escape_string($link,$_POST['emp_birth']):'';
//    $entry = isset($_POST['emp_entry']) ? mysqli_real_escape_string($link,$_POST['emp_entry']):'';
//
//    if(!($name && $dept && $birth && $entry)){
//        echo '<a href="addPlus.php"> 返回添加页面</a>';
//        echo '<br>';
//        die('员工信息不能为空');
//    } else{
//        $insertSql = "insert into emp_info(emp_name,emp_dept_id,emp_birth,emp_entry) VALUES ('$name',$dept,'$birth','$entry')";
//        dbQuery($link,$insertSql);
//        echo '<a href="page.php"> 返回员工列表</a>';
//        echo '<br>';
//        die('员工信息插入成功');
//    }
//}


if(empty($_POST)){
    $deptSql = 'select * from dept_info';
    $deptArr = dbFetchAll($link,$deptSql);
}else {
    $fieldArr = [
        'emp_name',
        'emp_dept_id',
        'emp_birth',
        'emp_entry'
    ];
//  字段为varchar 类型 的 字段 需要加上单引号‘’的集合
    $strArr = [
        'emp_name',
        'emp_birth',
        'emp_entry'
    ];

    $valueStr = [];
    foreach ($fieldArr as $item) {
        $value = isset($_POST[$item]) ? $_POST[$item] : '';

        if (empty($value)) {
            echo '<a href="addEmp.php"> 返回到添加页面</a>';
            die('员工信息不能为空');
        }
        if (in_array($item, $strArr)) {
            $valueStr[] = "'$value'";
        } else {
            $valueStr[] = $value;
        }

    }
    $fieldStr = implode(',',$fieldArr);
    $arr = implode(',',$valueStr);
    echo $arr;
    echo '<br>';
    echo $fieldStr;

    $insertSql = "insert into emp_info($fieldStr) VALUES ($arr)";
    echo 'sql =======>>'.$insertSql;
    dbQuery($link,$insertSql);

    header('location:./page.php');
//    echo '<a href="page.php"> 返回员工列表</a>';
    echo '<br>';
    die('员工信息插入成功');
}

?>

<div>
    <div>
        <h3>添加员工</h3>
    </div>
    <div>
        <form method="post" action="addEmp.php">
            <div>
                <label for="emp_name">姓名</label>
                <input type="text" name="emp_name" id="emp_name">
            </div>

            <div>
                <label for="emp_dept_id">部门</label>
                <select name="emp_dept_id" id="emp_dept_id">
                    <option value="">--请选择部门--</option>
                    <?php foreach ($deptArr as $item){?>
                        <option value="<?= $item['dept_id']?>"><?= $item['dept_name']?></option>
                    <?php }?>
                </select>
            </div>

            <div>
                <label for="emp_birth">出生日期</label>
                <input type="date" name="emp_birth" id="emp_birth">
            </div>

            <div>
                <label for="emp_entry">入职日期</label>
                <input type="date" name="emp_entry" id="emp_entry">
            </div>

            <div>
                <input type="submit" value="提交">
            </div>

        </form>
    </div>
</div>
</body>
</html>