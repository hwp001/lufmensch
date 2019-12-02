<?php
namespace app\main\validate;
use think\Validate;

class CityValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "name" => "require|max:25",
    ];

    //自定义提示信息
    protected $message = [
        "name.require" => "城市名不能为空",
        "name.max" => "城市名的长度不能超过25",
    ];
}