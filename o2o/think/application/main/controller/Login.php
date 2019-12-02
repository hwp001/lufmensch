<?php
namespace app\main\controller;
use think\captcha\Captcha;
use app\bis\validate\LoginValidate;
use Request,Db,Session;
use think\Controller;

/*
 * 登录首页
 */
class Login extends Controller
{
   //初始化模板
    public function index()
    {
        return $this->fetch();
    }

    //生成验证码
    public function verify()
    {
        //实例化验证码类
        $captcha = new Captcha();
        return $captcha->entry();
    }

    //用户登录
    public function login()
    {
        $data = Request::param();
        //实例化验证器
        $loginVali = new LoginValidate();
        if ($loginVali->check($data)) {   //第一步 检测验证码等输入数据不能为空
            //实例化验证码
            $captcha = new Captcha();
            //第二步 检测验证码是否正确
            if($captcha->check($data['code']))
            {
                //第三步 检测账户 密码 验证码
                $user = Db::name('admin')->where('username',$data['username'])->find();
                if ($user && (md5($user['code'].$data['password'])==$user['password']) && $user['status'] ==1) {
                    //登录成功，将用户名、id 存入Session中
                    Session::set('aname',$user['username']);
                    Session::set('aid',$user['id']);
                    $this->success('登录成功','index/index');
                }
                $this->error('账户不存在或者密码不正确或账户没有审核通过');
            }
            $this->error("验证码不正确");

        }

        //验证失败 提示信息
        $this->error($loginVali->getError());
    }

    //没有权限显示界面
    public function noPri()
    {
        return "没有权限";
    }

}