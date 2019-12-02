<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/15
 * Time: 22:46
 */

namespace app\home\controller;
use app\home\validate\LoginValidate;
use think\Controller;
use Db,Request,Session;

/*
 * 登录逻辑
 */
class Login extends Controller
{
    //显示登录首页
    public function index()
    {
        return $this->fetch( );
    }

    //用户登录
    public function login()
    {
        $data = Request::param();
        //实例化验证器
        $loginVali = new LoginValidate();
        if ($loginVali->check($data)) {   //第一步 检测验证码等输入数据不能为空
                //第三步 检测账户 密码 验证码
                $member = Db::name('member')->where('username',$data['username'])->find();
                if ($member && (md5($member['code'].$data['password'])==$member['password']) && $member['status'] ==1) {
                    //登录成功，将用户名、id 存入Session中
                    Session::set('mname',$member['username']);
                    Session::set('mid',$member['id']);
                    $this->success('登录成功','index/index');
                }
                $this->error('账户不存在或者密码不正确或账户没有审核通过');
            }

        //验证失败 提示信息
        $this->error($loginVali->getError());
    }
}