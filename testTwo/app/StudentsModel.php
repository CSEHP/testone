<?php
class StudentsModel{
    private $link;
    public  function __construct(){
        $this->link= new mysqli('127.0.0.1','root','WAN123','stum');
        $this->link->set_charset('utf8');
    }

//    查询所有
    public function getAll(){
        $sql = 'select * from students';
        $res = $this->link->query($sql);
        $data = $res->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
//    查询单个
    public function getOne($sno){
        $sql = "select * from students where sno=$sno ";
        $res = $this->link->query($sql);
        $data = $res->fetch_assoc();
        return $data;
    }
//    更新操作
    public function update($sno,$sname,$sex){
        $sql = "update students set sname='$sname',sex ='$sex' where sno ='$sno'";
        $res = $this->link->query($sql);
        return $res;
    }
}