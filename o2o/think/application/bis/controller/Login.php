<?php
namespace app\bis\controller;
use think\Controller;
use think\captcha\Captcha;
use think\facade\Session;
use think\facade\Request;
use think\Db;
use app\bis\validate\LoginValidate;
/*
 * 商户登录
 */
class Login extends Controller
{
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
                $user = Db::name('bis_account')->where('name',$data['username'])->find();
                if ($user && (md5($user['code'].$data['password'])==$user['password']) && $user['status'] ==1) {
                    //登录成功，将用户名、id 存入Session中
                    Session::set('name',$user['name']);
                    Session::set('uid',$user['id']);
                    Session::set('pid',$user['pid']);
                    $this->success('登录成功','index/index');
                }
                $this->error('账户不存在或者密码不正确或账户没有审核通过');
            }
            $this->error("验证码不正确");

        }

        //验证失败 提示信息
        $this->error($loginVali->getError());
    }

}
