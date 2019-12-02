<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 14:34
 */

namespace app\main\controller;
use app\main\controller\Base;
use app\common\model\Role;
use app\common\model\Node as Nod;
use app\common\model\NodeRole;
use Request,Db;
class Node extends Base
{
    //初始页面
    public function index()
    {
        //从管理员角色表中获取 管理员和角色
        $sql = "select n.id,n.name,n.imageUrl,r.name as roleName,n.loginTimes,n.Ip,n.loginTime,n.trueName,n.state  from vehicle_node as           n,vehicle_role as r,vehicle_node_role as nr where n.id = nr.nodeId and r.id = nr.roleId;";
        $nodes = Db::query($sql);
        $this->assign([
            'nodes' => $nodes
        ]);
        return $this->fetch();
    }
    //新增管理员
    public function add()
    {
        if (Request::isPost()){
            $data = Request::param();
            //获取盐值
            $code = random();
            $nodeD = [
                'name'      =>$data['name'],
                'code'      =>$code,
                'pwd'       => md5($code.$data['pwd']),
                'trueName' => $data['trueName'],
                'imageUrl' => $data['imageUrl'],
                'state'    => $data['state']
            ];
            //开启事务 新增完管理员表 才能新增管理员角色表
            Db::startTrans();
            //新增管理员表
            $nodeId = (new Nod())->add($nodeD);
            if ($nodeId !== false){
                $nrD = [
                    'nodeId' => $nodeId,
                    'roleId' => $data['roleId']
                ];
                //新增管理员-角色表
                $nrId = (new NodeRole)->add($nrD);
                if ($nrId !== false) {
                    Db::commit();
                    $this->success('新增管理员成功','index');
                } else {
                    Db::rollback();
                    $this->error('新增管理员失败');
                }
            } else {
                Db::rollback();
                $this->error('新增管理员失败');
        }

        }
        //获取分配权限的角色  优化改成级联操作
        $sql = 'select r.id,r.name,group_concat(a.name) as roleName from vehicle_role as r,vehicle_role_auth as ra,
                      vehicle_auth as a where r.id = ra.roleId and ra.authId = a.id group by roleId; ';
        $roleAuths = Db::query($sql);
        $this->assign([
            'roleAuths' => $roleAuths
        ]);
        return $this->fetch();
    }

}