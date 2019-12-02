<?php
namespace app\index\controller;
use think\Controller;
use Request;
use Log;
class Index extends Controller
{


    public function index()
    {
        return 'hello';
    }

    public function hello()
    {
        echo phpinfo();
    }
}
