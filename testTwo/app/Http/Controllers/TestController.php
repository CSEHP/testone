<?php
namespace app\Http\Controllers;

use myframe\Container;
use myframe\Request;

class TestController
{
    protected $request;
    public function __construct(Request $request)
    {
        //$this->request = (Container::getInstance())->make(Request::class);
        $this->request = $request;
    }
    public function index()
    {
        $id = $this->request->get('id');
        return $id;
    }
}
