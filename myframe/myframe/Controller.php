<?php
namespace myframe;

use myframe\Request;
use myframe\App;
use Smarty;

class Controller
{
    protected $app;
    protected $request;
    protected $Smarty;
    public function __construct(App $app, Request $request, Smarty $Smarty)
    {
        $this->app = $app;
        $this->request = $request;
        $this->Smarty = $Smarty;
        $this->Smarty->template_dir = $app->getRootPath().'resources/views/';
        $this->Smarty->compile_dir = $app->getRootPath().'storage/framework/views/';
    }
    public function assign($name, $value = '')
    {
        $this->Smarty->assign($name, $value);
    }
    public function fetch($template = '')
    {
        return $this->Smarty->fetch($template.'.html');
    }
}
