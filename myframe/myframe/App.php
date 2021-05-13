<?php
namespace myframe;

use ReflectionMethod;
use Exception;

class App extends Container
{
    protected $request;
    protected $debug = true;
    protected $rootPath;
    /**
     * @description: 创建Request对象初始化成员属性$request
     */
    public function __construct()
    {
        $this->instances[App::class] = $this;
        $this->request = $this->make(Request::class);
        $this->rootPath = dirname(__DIR__) . '/';
        $config = require $this->rootPath.'config/database.php';
        DB::init($config);
    }
    /**
     * @description: 获取项目根目录
     * @return {Response} 项目根目录
     */
    public function getRootPath()
    {
        return $this->rootPath;
    }
    /**
     * @description: 启动应用
     * @return {Response} 响应对象
     */
    public function run()
    {
        try {
            $dispatch = $this->routeCheck();
            return $this->dispatch($dispatch);
        } catch (Exception $e) {
            $msg = $this->debug ? $e->getMessage() : '';
            return Response::create('系统发生错误: '.$msg, 403);
        }
    }
    /**
     * @description: 路由检测
     * @return {array} 控制器和方法名
     */
    public function routeCheck()
    {
        $pathinfo = $this->request->pathinfo();
        $controller = dirname($pathinfo);
        $action = basename($pathinfo);
        $arr = explode('/', ucwords($controller, '/'));
        $controller = implode('\\', $arr).'Controller';
        $arr[] = $action;
        foreach ($arr as $v) {
            if (!preg_match('/^[A-Za-z]\w{0,20}$/', $v)) {
                throw new Exception('请求参数包含特殊字符');
            }
        }
        return [$controller, $action];
    }
    /**
     * @description: 请求分发
     * @param {array} $dispatch 前两个元素是控制器和方法名
     * @return {Response} 响应对象
     */
    public function dispatch(array $dispatch)
    {
        list($controller, $action) = $dispatch;
        $instance = $this->controller($controller);
        if (is_callable([$instance, $action])) {
            $method = new ReflectionMethod($instance, $action);
        } else {
            throw new Exception('操作不存在：'.get_class($class).'/'.$action);
        }
        $args = $this->bindParams($method);
        $data = $method->invokeArgs($instance, $args);
        return Response::create($data);
    }
    /**
     * @description: 根据控制器名称创建控制器实例
     * @param {*} $name 控制器名
     * @return {*} 控制器实例
     */
    public function controller($name)
    {
        $className = '\\App\\Http\\Controllers\\'.$name;
        if (!class_exists($className)) {
            throw new Exception('请求的控制器：'.$className.'不存在！');
        }
        return $this->make($className);
    }
}
