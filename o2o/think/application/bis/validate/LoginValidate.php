<?php
namespace app\bis\validate;
use think\Validate;

class LoginValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "username"  =>  "require",
        "password"  =>  "require",
        "code"       =>  "require"
    ];

    //自定义提示信息
    protected $message = [
        "username.require" => "用户名不能为空",
        "password.require" => "密码不能为空",
        "code.require"      => "验证码不能为空",
    ];
}