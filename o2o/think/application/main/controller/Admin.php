<?php
namespace app\main\controller;
use app\main\controller\Base;
use app\common\model\Role;
use app\main\validate\AdminValidate;
use app\common\model\Admin as Admi;
use Request,Db;

/**
 * 管理员
 * @package app\main\controller
 */
class Admin extends Base
{
    //实现管理员列表
    public function index()
    {
       //构建查询的sql
       $sql = "select ad.username as username,group_concat(ro.role_name) as role_name from six_admin as ad 
              left join six_admin_role as adr on ad.id = adr.admin_id 
              left join six_role as ro on adr.role_id = ro.id group by ad.username; ";
       $admins = Db::query($sql);
       $this->assign("admins",$admins);
        return $this->fetch();
    }

    //添加管理员
    public function add()
    {
       if (Request::isPost()) {
           //接收管理员数据
           $data = Request::param();
           //实例化验证器
           if ((new AdminValidate())->check($data)) {
                $code = random(); //生成随机字符串
               $userData = [
                   "username" => $data["username"],
                   "password" => md5($code.$data['password']),
                   "code"  => $code,
                   "status" => $data["status"],
               ];
               //获取管理员的id
               $uid = (new Admi()) ->add($userData);
               //角色id
               $roleId = $data["role_id"];
               foreach ($roleId as $id) {
                   $newData[] = ['role_id' => $id,"admin_id" => $uid];
               }

               $rows =  Db::name("admin_role")->insertAll($newData);

               if (!$rows) {
                   $this->error("添加失败");
               }
               $this->success("添加成功",'admin/index');
           }
       }

        //获取角色列表
        $roles = (new Role())->getRoleList();
        $this->assign("roles",$roles);

        return $this->fetch();
    }
}