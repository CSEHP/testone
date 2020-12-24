<?php
require_once "Fruit.class.php";
class Apple extends Fruit
{
    private $price;
    private $FWigth;
//  构造函数
    public function __construct($FType,$FColor,$price, $FWight)
    {
        parent::__construct($FType,$FColor);
        $this->price = $price;
        $this->FWigth = $FWight;
    }
//    定义方法
    function show_apple(){
        echo "类型：".$this->FType."，颜色：".$this->FColor.",价格：".
            $this->price.",重量：".$this->FWigth;
    }
}