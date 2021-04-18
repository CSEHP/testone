<?php
namespace myframe;

class Request
{
    protected $pathinfo;
    /**
     * @description: 解析PATH_INFO
     * @return {string} 去除最左边的“/”后的PATH_INFO参数
     */
    public function pathinfo()
    {
        if (is_null($this->pathinfo)) {
            $this->pathinfo = $this->server('PATH_INFO')
            ? $this->server('PATH_INFO')
            : $this->server('REDIRECT_PATH_INFO');
        }
        return ltrim($this->pathinfo, '/');
    }
    /**
     * @description: 获取$_SERVER中的数据
     * @param {mixed} $name $_SERVER中的键名
     * @param {mixed} $default 元素不存在时的默认值
     * @return {mixed} $_SERVER中的指定键名的值
     */
    public function server($name, $default = null)
    {
        return isset($_SERVER[$name]) ? $_SERVER[$name] : $default;
    }
    /**
     * @description: 获取$_GET中的数据
     * @param {mixed} $name $_GET中的键名
     * @param {mixed} $default 元素不存在时的默认值
     * @return {mixed} $_GET中的指定键名的值
     */
    public function get($name, $default = null)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }
    
    public function post($name, $default = null)
    {
        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }
}
