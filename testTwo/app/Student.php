<?php
/*
 * @Author: your name
 * @Date: 2021-04-15 10:23:55
 * @LastEditTime: 2021-04-22 10:52:17
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \myframe-exception\app\student.php
 */
namespace App;

use mysqli;
use PDO;

class Student
{
    // private $link;
    // public function __construct()
    // {
    //     $this->link= new mysqli('127.0.0.1', 'root', 'root', 'stum');
    //     $this->link->set_charset('utf8');
    // }
    private $pdo;
    public function __construct()
    {
        $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=stum;charset=utf8';
        $this->pdo = new PDO($dsn, 'root', 'root');
    }

//    查询所有
    public function getAll()
    {
        $sql = 'select * from students';
        // $res = $this->link->query($sql);
        // $data = $res->fetch_all(MYSQLI_ASSOC);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
//    查询单个
    public function getOne($sno)
    {
        // $sql = "select * from students where sno=$sno ";
        // $res = $this->link->query($sql);
        // $data = $res->fetch_assoc();
        // return $data;

        $sql = 'select * from students where sno= ?';
        $stmt =$this->pdo->prepare($sql);
        $stmt->bindParam(1, $sno);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
//    更新操作
    public function update($sno, $sname, $sex)
    {
        // $sql = "update students set sname='$sname',sex ='$sex' where sno ='$sno'";
        // $res = $this->link->query($sql);
        
        $sql = "update students set sname= ? ,sex = ? where sno = ?";
        $stmt =$this->pdo->prepare($sql);
        $stmt->bindParam(1, $sno);
        $stmt->bindParam(2, $sname);
        $stmt->bindParam(3, $sex);
       
        return $stmt->execute();
    }
}
