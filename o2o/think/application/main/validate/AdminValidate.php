<?php
namespace app\main\validate;
use think\Validate;

class AdminValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "username" => "require",
    ];

    //自定义提示信息
    protected $message = [
        "username.require" => "用户名称不能为空",
    ];
}