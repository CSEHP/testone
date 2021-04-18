<?php
namespace App\Http\Controllers;

use myframe\Request;

class DemoController
{
    public function test(Request $request)
    {
        $name = $request->get('name');
        return $name;
    }
}
