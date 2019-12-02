<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/14
 * Time: 14:38
 */

namespace app\bis\controller;
use think\Controller;
use Session;
class Base extends Controller
{
    // 初始化
    protected function initialize()
    {
//        //判断用户是否登录
//        if (!Session::has('uid')) {
//            $this->redirect("login/index");
//        }
    }
}