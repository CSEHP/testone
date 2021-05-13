<?php
/*
 * @Author: your name
 * @Date: 2021-05-11 20:08:12
 * @LastEditTime: 2021-05-13 17:45:07
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \myframe\app\Http\Controllers\studentController.php
 */
namespace App\Http\Controllers;

use myframe\Controller;
use myframe\Request;
use myframe\App;
use App\student;
use smarty;

class StudentController extends Controller 
{
    public function index(Student $studentModel)
    {
        $data = $studentModel->get();
        $this->assign('data',$data);
        return $this->fetch('students');
    }

    public function getOne(Student $studentModel)
    {
        $id = $this->request->get('id');
        if (!$id) {
            throw new Execption('学生ID传递有误！');
        }
        $data = $studentModel->where('id', $id)->first();
        $this->assign('data', $data);
        return $this->fetch('student');
    }
    public function update(Student $studentModel)
    {
        $id =$this->request->post('id');
        if (!$id) {
            throw new Execption('学生ID传递有误！');
        }
        $data['name'] = $this->request->post('name');
        $data['gender'] = $this->request->post('gender');
        $data['email'] = $this->request->post('email');
        $data['mobile'] = $this->request->post('mobile');

        $res = $studentModel->where('id', $id)->update($data);
        
        if ($res) {
            return '修改成功！！';
        }
        return '编辑失败 ！！';
    }
    
}
