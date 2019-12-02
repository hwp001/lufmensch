<?php
namespace app\home\controller;
use app\home\validate\RegisterValidate;
use think\Controller;
use Rquest,Session;

class Register extends Controller
{
    //显示首页
    public function index()
    {
        return $this->fetch();
    }

    //获取注册的数据   注册成功默认直接登录
    public function register()
    {

        if (request()->isPost()) {
            $model = model('Member'); //  实力化一个模型
            $data = input('post.'); //  获取请求数据

            //验证数据
            $regisVali = new RegisterValidate();
            $result = $regisVali->check($data);
            if (true !== $result) {
                $this->error($regisVali->getError());  //验证失败 输出错误信息
                exit;
            }
            //短信验证码验证
            $code = Session::get('code');
            if ($code != $data["code"]) {
                $this->error("短信验证码不正确");exit;
            }

            //获取随机字符串
            $str = random();
            //构建用户数据
            $data = [
                "username" => $data['username'],
                "password" => md5($str.$data["password"]),
                "code" => $str,
                "status" => 1,   //默认启用
            ];


            $mid = $model->add($data);

            if ($mid) {
                //将会员名 和 id 写入 session 中
                Session::set("mname",$data['username']);
                Session::set("mid",$mid);
                $this->success('注册成功','index/index');
            } else {
                $this->error('注册失败');
            }

        }
    }
}