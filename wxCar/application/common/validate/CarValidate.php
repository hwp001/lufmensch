<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/2
 * Time: 16:52
 */
namespace app\common\validate;
use think\Validate;

class CarValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "license"     => "unique:Car",
        "carThree" => "require|alphaNum|length:5"
    ];
    //自定义提示信息
    protected $message = [
        "license.auth"          => '权限名称不能重复',
        "carThree.require"  => '车牌号尾号没填',
        "carThree.alphaNum" => '车牌号尾号为字母数字组合',
        "carThree.length"   => '车牌号尾号长度固定为5'
    ];
}