<?php
namespace app\bis\validate;
use think\Validate;

class BisValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "name" => "require|max:25",
        "email" => "require|email",
        "tel" => "require|mobile"
    ];

    //自定义提示信息
    protected $message = [
        "name.require" => "名称不能为空",
        "name.max" => "名称的长度不能超过25",
        "email.require" => "邮箱不能为空",
        "email.email" => "邮箱不合法",
        "tel.require" => "电话号码不能为空",
        "tel.mobile" => "电话不合法"
    ];
}