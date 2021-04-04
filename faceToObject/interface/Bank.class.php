<?php
require_once "Payment.interface.php";
class Bank implements Payment
{
    private $uname;
    private $umoney;
    private $upwd;
// 构造函数
    public function __construct($uname, $umoney, $upwd)
    {
        $this->uname = $uname;
        $this->umoney = $umoney;
        $this->upwd = $upwd;
    }

//支付方法
    function pay()
    {
       echo "当前用户：".$this->uname.",转账金额：".$this->umoney;
    }
}