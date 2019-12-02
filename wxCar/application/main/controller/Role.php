<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 14:49
 */

namespace app\main\controller;
use app\main\controller\Base;
use app\common\validate\RoleValidate;
use app\common\validate\RoleAuthValidate;
use app\common\model\Role as Rol;
use app\common\model\Auth;
use app\common\model\RoleAuth;
use Request,Config,Log,Db;
class Role extends Base
{
    //初始页面
    public function index()
    {
        $roles = (new Rol())->getRoles();
        //获取分配权限的角色
        $sql = 'select r.id,r.name,group_concat(a.name) as roleName from vehicle_role as r,vehicle_role_auth as ra,
                      vehicle_auth as a where r.id = ra.roleId and ra.authId = a.id group by roleId; ';
        $roleAuths = Db::query($sql);
        $this->assign([
            'roles'      => $roles,
            'roleAuths' => $roleAuths
        ]);
        return $this->fetch();
    }
    //新增角色名
    public function add()
    {
        if (Request::isPost()) {
            $name = Request::param('name');
            $state = Request::param('state');
            $data = [
                'name'  => $name,
                'state' => $state
            ];
            $roleVali = new RoleValidate();
            if ($roleVali->check($data)){
                    $rows = (new Rol())->add($data);
                    if ($rows !== false) {
                        $this->success('角色添加成功','Role/index');
                    } else {
                        $this->error("角色添加失败");
                    }
            } else {
                $this->error($roleVali->getError());
            }
        }
        return $this->fetch();
    }

    //权限分配
    public function role_auth()
    {
        if (Request::isPost())
        {
            $roleId = Request::param('roleId');
            //实例化角色权限表
            $roleAuth  =  new RoleAuth();
            $row = $roleAuth->find($roleId);
            //验证角色是否已经分配权限 false还未分配
            if ($row === false){
                $auth = Request::param('auth');
                if (empty($auth)){
                    $this->error('分配权限不能为空');
                }
                foreach ($auth as $k => $v) {
                    $data[] = [
                        'roleId' => $roleId,
                        'authId' => $v
                    ];
                }
                $rows =$roleAuth->addRoleAuths($data);
                if ($rows !== false){
                    $this->success('角色成功分配权限','index');
                } else {
                    $this->error('角色权限分配失败');
                }
            } else {
                $this->error('角色已经分配过权限');
            }
        }
        $roles = (new Rol())->getRoles();
        $auths = (new Auth())->getAuths();
        $authTpl = config::get('authTpl.');
        $this->assign([
            'roles'     => $roles,
            'auths'     => $auths,
            'authTpl'   => $authTpl,
        ]);
        return $this->fetch();
    }
}


















