<?php
/*
 * @Author: your name
 * @Date: 2021-04-15 10:25:38
 * @LastEditTime: 2021-04-15 11:28:39
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \myframe-exception\app\Http\Controllers\StudentController.php
 */
namespace App\Http\Controllers;

use myframe\Request;
use App\Student;

require '../vendor/autoload.php';

const VIEW_PATH ='../resources/views/';

class StudentController
{


    protected $studentModel;
    protected $request;
    public function __construct(Student $studentModel, Request $request)
    {
        $this->studentModel=$studentModel;
        $this->request = $request;
    }

//    查全
    public function index()
    {
        $data = $this->studentModel->getAll();
        require VIEW_PATH.'StudentAllView.php';
    }
//    查单
    public function getOne()
    {
        $sno =$this->request->get('sno');
        $data=$this->studentModel->getOne($sno);
        require VIEW_PATH.'StudentInfoView.php';
    }

//    更新操作
    public function update()
    {
        $sno=$this->request->post('sno');
        $sname=$this->request->post('sname');
        $sex=$this->request->post('sex');
       
        $res = $this->studentModel->update($sno, $sname, $sex);
        if ($res) {
            echo '修改成功！';
        } else {
            echo '修改失败！';
        }
    }
    //测试
    public function test()
    {
        echo 'test ---=-';
    }
}
