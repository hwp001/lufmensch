<?php
namespace app\main\validate;
use think\Validate;

class PrivilegeValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "pri_name" => "require",
    ];
    //自定义提示信息
    protected $message = [
        "pri_name.require" => "名称不能为空",
    ];
}