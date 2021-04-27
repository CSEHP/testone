<?php
/*
 * @Author: your name
 * @Date: 2021-04-15 10:23:55
 * @LastEditTime: 2021-04-15 11:30:48
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \myframe-exception\app\student.php
 */
namespace App;

use myframe\DB;

class Student
{
    protected $db;
    public function __construct(DB $db)
    {
        $this->db =new DB();
    }

//    查询所有
    public function getAll()
    {
        $sql = 'select * from students';
        $data = $this->db->fetchAll($sql);
        return $data;
    }
//    查询单个
    public function getOne($sno)
    {
        $sql = 'select * from students where sno= ?';
        $data = $this->db->fetchRow($sql, [$sno]);
        return $data;
    }
//    更新操作
    public function update($sno, $sname, $sex)
    {
        $sql = "update students set sname= ? ,sex = ? where sno = ?";
        $res = $this->db->execute($sql, [$sname, $sex, $sno]);
        return $res;
    }
}
