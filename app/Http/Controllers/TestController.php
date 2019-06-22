<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public static function index()
    {
        return 'I am Test Controller';
    }
    public static function add($num1, $num2)
    {
        return $num1 + $num2;
    }

}
