<?php
/**
 * 用来处理zh_user表的业务逻辑
 */

namespace app\index\controller;
use app\common\controller\Base;
use think\facade\Request;
use app\common\model\User as UserModel;
class User extends Base
{
    //注册页面
    public function register()
    {
        $this->assign('title','用户注册');
        return $this->fetch();
    }

    //处理用户提交过来注册信息
    public function insert()
    {

//        return UserModel::get(1);
//     return   UserModel::create([
//            'name'=> 'nihao',
//            'email' => 'www.php.cn',
//            'mobile' => '12345554554',
//            'password' => '31231hfs',
//        ]);

        if (Request::isAjax()){
            //验证规则
            $data = Request::post(); //获取post方式提交的全部数据
            $rule = 'app\common\validate\User';
            $res = $this->validate($data,$rule);
//            return $res;
            //使用模型来创建数据
            //获取用户通过表单提交过来的数据，过滤掉"password_confirm"
            $data = Request::except('password_confirm', 'post');
            if (true !== $res) {
                return ['status'=>-1,'message'=>$res];
            } else {
                if (UserModel::create($data)){
                    return ['status'=>1,'message'=>'恭喜，注册成功'];
                } else {
                    return ['status'=>0,'message'=>'注册失败，请检查'];
                }
            }
        } else {
            //重定向
            $this->error("请求类型错误", 'register');
        }
    }
}