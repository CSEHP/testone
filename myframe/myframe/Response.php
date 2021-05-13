<?php
/*
 * @Author: xinranlin
 * @Date: 2021-04-12 18:51:13
 * @LastEditTime: 2021-04-12 18:52:29
 * @LastEditors: Please set LastEditors
 * @Description: 响应类
 * @FilePath: /myframe/myframe/Response.php
 */
namespace myframe;

class Response
{
    protected $code = 200;
    protected $header = [];
    protected $data = '';
    /**
     * @description: 初始化成员属性
     * @param {mixed} $data 响应数据
     * @param {int} $code 响应状态码
     * @param {array} $header 响应头
     */
    public function __construct($data = '', $code = 200, $header = [])
    {
        $this->data = $data;
        $this->code = $code;
        $this->header = array_merge($this->header, $header);
    }
    /**
     * @description: 输出响应数据
     */
    public function send()
    {
        http_response_code($this->code);
        header('Content-type:text/html');
        foreach ($this->header as $k => $v) {
            header($k.(is_null($v) ? '' : ':'.$v));
        }
        echo $this->data;
    }
    /**
     * @description: 创建Response对象
     * @param {mixed} $data 响应数据
     * @param {int} $code 响应状态码
     * @param {array} $header 响应头
     * @return {Response} 响应对象
     */
    public static function create($data = '', $code = 200, $header = [])
    {
        return new static($data, $code, $header);
    }
}
