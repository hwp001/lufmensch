<?php
namespace app\main\controller;
use app\main\controller\Base;
use app\main\validate\PrivilegeValidate;
use app\common\model\Privilege as pri;
use Request;

/**
 * 权限逻辑处理
 * @package app\main\controller
 */
class Privilege extends Base
{
   //显示权限列表
    public function index()
    {
        $Pris = (new Pri())->getall();
        $this->assign('Pris',$Pris);
        return $this->fetch();
    }

    //添加权限
    public function add()
    {
       if (Request::isPost()) {
            $data = Request::param();
            $priVali = new PrivilegeValidate();
            if ($priVali->check($data)) {
                $data['delete_time'] = 0;
                $privilege = (new pri())->add($data);
                $this->success("添加成功","privilege/index");
            }
            $this->error($priVali->getError());
       }
        //实例化权限的模型
        $privilege = new pri();
        $privileges = $privilege->getTreePrivilege();
        $this->assign('privileges',$privileges);
        return $this->fetch();
    }
}