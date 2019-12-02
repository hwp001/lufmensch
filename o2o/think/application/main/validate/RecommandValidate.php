<?php
namespace app\main\validate;
use think\Validate;

class RecommandValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "title" => "require",
        "url"   => "require|url"
    ];

    //自定义提示信息
    protected $message = [
        "title.require" => "城市名不能为空",
        "url.require"  => "url不能为空",
        "url.url"      => "url不符合规则"
    ];
}