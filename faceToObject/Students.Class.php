<?php

class Students
{
private $host;
private $user;
private $password;
private $dbName;
private $charSet;
public $link;

    /**
     * Students constructor.
     * @param $host
     * @param $user
     * @param $password
     * @param $dbName
     * @param $charSet
     * @param $link
     */
    public function __construct($host, $user, $password, $dbName, $charSet, $link)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->charSet = $charSet;
        $this->link = $link;

        $link = mysqli_connect($host,$user,$password,$dbName);
        mysqli_set_charset($link,'utf8');
    }

    /**
     * 执行sql 返回资源结果集
     * @param $link
     * @param $sql
     * @return bool|mysqli_result
     */
    public function query($link,$sql)
    {
        return mysqli_query($link,$sql);
    }

    /**
     * 查询单条信息记录
     * @param $link
     * @param $sql
     * @return string[]|null
     */
    public function fetchOne($link,$sql)
    {
        $res = $this->query($link,$sql);
        return mysqli_fetch_assoc($res);
    }


}