<?php
namespace myframe;

class App extends Container
{
    protected  $request;

    public function __construct()
    {
    //   return $this->request = new Request();
    // $this->request = Container::getInstance()->make(Request::class);
        $this->request = $this->make(Request::class);
    }

    //run 方法 去检查路由 和 dispath 方法 的 调用
    public function run()
    {
        $dispath = $this->routCheck();
        $this->dispath($dispath);
    }

    public function routCheck()
    {
        $pathinfo=$this->request->pathInfo();
        $controller = dirname($pathinfo);
        $action = basename($pathinfo);
        $arr =explode('/',ucwords($controller,'/'));
        $controller =implode('\\',$arr).'Controller';
        $arr[] = $action;

        foreach ($arr as $item) {
            if (!preg_match('/^[A-Za-z]\w{0,20}$/', $item))
            {
                die('请求参数 包含 特殊字符！！');
            }
        }
        return [$controller,$action];
    }

    public function controller($name)
    {
        $className = '\\App\\Http\\Controllers\\'.$name;
        if (!class_exists($className))
        {
            die('请求的控制器'.$className.'不存在!');
        }
        // return new $className();
        return $this->make($className);
    }

    //实例化 对象 调用对应方法
    public function dispath(array $dispath)
    {
        list($controller,$action) =$dispath;
        $instance =$this->controller($controller);
        $data =$instance->$action();

        return Response::create($data);
    }
}
