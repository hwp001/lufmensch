<?php
namespace app\bis\validate;
use think\Validate;

/**
 * 新增门店验证器
 * @package app\bis\validate
 */
class LocationValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "address"  =>  "require",
        "tel"  =>  "require|mobile",
    ];

    //自定义提示信息
    protected $message = [
        "address.require" => "店铺地址不能为空",
        "tel.require" => "电话号码不能为空",
        "tel.mobile" => "电话号码不符合规则",
    ];
}