<?php
namespace app\main\controller;
use think\Controller;
use Session;

/*
 * 后台首页
 */
class Index extends Controller
{
    protected function initialize()
    {
        if (!Session::has('aid')) {
            $this->redirect("login/index");
        }
    }

    public function index()
    {
       return $this->fetch();
    }
}