<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
     return 'hello';
    }

    public function test()
    {
        return phpinfo();
    }
}
