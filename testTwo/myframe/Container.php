<?php
/*
 * @Author: your name
 * @Date: 2021-04-12 18:34:49
 * @LastEditTime: 2021-04-12 23:23:50
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /myframe/myframe/Container.php
 */
namespace myframe;

use ReflectionClass;
use ReflectionMethod;

class Container
{
    protected $instances = [];
    protected static $instance;
    /**
     * @description: 创建对象
     * @param {string} $classname 类名
     * @return {mixed} 实例对象
     */
    public function make($classname)
    {
        if (!isset($this->instances[$classname])) {
            $reflect = new ReflectionClass($classname);
            $constructor = $reflect->getConstructor();
            $args = $constructor ? $this->bindParams($constructor) : [];
            $this->instances[$classname] = $reflect->newInstanceArgs($args);
        }
        return $this->instances[$classname];
    }
    /**
     * @description: 获取方法依赖的参数
     * @param {ReflectionMethod} $method 方法的反射
     * @return {array} 参数列表
     */
    public function bindParams(ReflectionMethod $method)
    {
        $args = [];
        $params = $method->getParameters();
        foreach ($params as $param) {
            $class = $param->getClass();
            if ($class) {
                $args[] = $this->make($class->getName());
            }
        }
        return $args;
    }
    /**
     * @description: 单例模式创建自身实例对象
     * @return {mixed} 实例对象
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
