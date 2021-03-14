<?php
class StudentController{

//    查全
    public function index(){
        require 'StudentsModel.php';
        $model = new StudentsModel();
        $data = $model->getAll();
        require '../views/studentView.php';
    }
//    查单
    public function getOne(){
        $sno = isset($_GET['sno']) ? $_GET['sno'] : '';
        require 'StudentsModel.php';
        $model = new StudentsModel();
        $data=$model->getOne($sno);
        require '../views/StudentInfoView.php';
    }
//    更新操作
    public function update(){
        require 'StudentsModel.php';
        $sno = $_POST['sno'];
        $sname =$_POST['sname'];
        $sex = $_POST['sex'];

        $model = new StudentsModel();
        $res = $model->update($sno,$sname,$sex);
        if ($res){
            echo '修改成功！';
        }else{
            echo '修改失败！';
        }
    }
}