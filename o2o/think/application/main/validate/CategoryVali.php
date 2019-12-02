<?php
namespace app\main\validate;
use think\Validate;

class CategoryVali extends Validate
{
    //自定义规则
    protected $rule = [
        "name" => "require|max:25",
    ];

    //自定义提示信息
    protected $message = [
        "name.require" => "名称不能为空",
        "name.max" => "名称的长度不能超过25",
    ];
}