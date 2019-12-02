<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/15
 * Time: 18:15
 */

namespace app\main\controller;
use think\Controller;
use Request,Db,Session;

//基类
class Base extends Controller
{
        protected function initialize()
        {
//            //判断用户是否登录
//            if (!Session::has('aid')) {
//                $this->redirect("login/index");
//            }

//            //获取当前请求 控制器 和 方法
//            $module = Request::module();
//            $controller = Request::controller();
//            $action = Request::action();
//
//            //获取当前用户名
//            $aid = Session::get('aid');
//            $aname = Session::get('aname');
//            if ($aname != 'root') {
//                $sql = "select ad.username as username,pri.pri_name as pri_name from six_admin as ad
//                    left join six_admin_role as adr on ad.id = adr.admin_id
//                    left join six_role as ro on ro.id = adr.role_id
//                    left join six_role_pri as rop on rop.role_id = ro.id
//                    left join six_privilege as pri on pri.id = rop.pri_id
//                    where ad.id = $aid and pri.module_name = '$module'
//                     and pri.controller_name = '$controller' and pri.action_name = '$action'";
////                echo $sql;die;
//                $row = Db::query($sql);
//                if (!$row) {
//                    $this->error('没有权限','login/noPri');
//                }
//        }
    }
}