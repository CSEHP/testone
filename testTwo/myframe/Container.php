<?php
namespace myframe;

class Container
{
    protected $instances=[];
    protected static $instance;

    public function make($class)
    {
        if (!isset($this->instances[$class])) {
            $this->instances[$class]= new $class;
        }
        return  $this->instances[$class];
    }

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    } 

}