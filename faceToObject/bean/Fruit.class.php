<?php
class Fruit
{
    protected $FType;
    protected $FColor;

//    构造函数
    public function __construct($FType, $FColor)
    {
        $this->FType = $FType;
        $this->FColor = $FColor;
    }
}