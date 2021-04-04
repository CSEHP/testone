<?php
namespace myframe;

class Request
{
    protected $pathinfo;

    public function  pathInfo()
    {
        if (is_null($this->pathinfo)) {
            $this->pathinfo=$this->server('PATH_INFO') ? $this->server('PATH_INFO'):$this->server('REDIRECT_PATH_INFO');
        }
        return ltrim($this->pathinfo,'/');
    }

    public function server($name,$default=null)
    {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : $default;
    }
}
