<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/16
 * Time: 13:55
 */

namespace app\home\validate;
use think\Validate;


/*
 * 登录验证器
 */
class LoginValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "username"  =>  "require",
        "password"  =>  "require",
    ];

    //自定义提示信息
    protected $message = [
        "username.require" => "用户名不能为空",
        "password.require" => "密码不能为空",
    ];
}