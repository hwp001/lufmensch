<?php
namespace app\main\validate;
use think\Validate;

class RoleValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "role_name" => "require",
    ];
    //自定义提示信息
    protected $message = [
        "role_name.require" => "名称不能为空",
    ];
}