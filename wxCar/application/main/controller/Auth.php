<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 15:04
 */

namespace app\main\controller;
use app\common\validate\AuthValidate;
use app\main\controller\Base;
use app\common\model\Auth as Aut;
use Config,Request,Log;
class Auth extends Base
{
    //初始页面
    public function index()
    {
        $auths = (new Aut())->getAuths();
        $authTpl = config::get('authTpl.');
        $this->assign([
            'auths'   =>$auths,
            'authTpl' =>$authTpl
        ]);
        return $this->fetch();
    }

    //添加权限页面
    public function add()
    {
        if (Request::isPost()) {
            $name  = Request::param('name');
            $func  = Request::param('func');
            $state = Request::param('state');
            $func  = implode('@',$func);
            $data  = [
                'name'  => $name,
                'pid'   => $func,
                'state' => $state
            ];
            $authVali = new AuthValidate();
            if ($authVali->check($data)) {
                $rows = (new Aut())->add($data);
                if ($rows !== false) {
                    $this->success('添加权限成功','Auth/index');
                } else {
                    $this->error('添加权限失败');
                }
            } else {
                $this->error($authVali->getError());
            }


        }
        $auths = config::get('authTpl.');
        $this->assign('auths',$auths);
        return $this->fetch();
    }

}