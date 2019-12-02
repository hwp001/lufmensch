<?php
namespace app\main\controller;
use app\main\controller\Base;
use app\main\validate\RoleValidate;
use app\common\model\Role as Rol;
use app\common\model\Privilege;
use Request,Db;

/**
 * 角色逻辑处理
 * @package app\main\controller
 */
class Role extends Base
{
    //显示角色列表
    public function index()
    {
        //获取全部角色
        $allRoles = (new Rol())->getAllRole();
        $this->assign('allRoles',$allRoles);
        return $this->fetch();
    }


    /*
     * 思路：
     * 因为角色权限表没有设置主键，一行：一个权限ID 一个角色ID
     * 一个多个权限都是这样
     */
    //添加角色
    public function add()
    {
        if (Request::isPost()) {
            //获取角色数据
            $data = Request::param();
            //实例化验证其
            $roleVali = new RoleValidate();
            if ($roleVali->check($data)) {
                $rid = (new Rol())->add(['role_name'=>$data['role_name']]); //角色id
                $priId = $data["pri_id"];  //权限id
                foreach ($priId as $id) {
                    $newData[] = ["pri_id" => $id,"role_id" => $rid];
                }
                $row = Db::name("role_pri")->insertAll($newData);
                if (!$row) {
                    $this->error("添加失败");
                }
                $this->success("添加成功","role/index");
            }
            $this->error($roleVali->getError());
        }
        //获取权限列表
        //实例化权限的模型
        $privilege = new Privilege();
        $privileges = $privilege->getTreePrivilege();
        $this->assign('privileges',$privileges);
        return $this->fetch();
    }


}