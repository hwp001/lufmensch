<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 17:41
 */

namespace app\common\validate;

use think\Validate;

class OrderValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "carTwo"   => "require",
        "carThree" => "require|alphaNum|length:5"
    ];
    //自定义提示信息
    protected $message = [
        "carTwo.require"    => '请选择具体类型',
        "carThree.require"  => '车牌号尾号有误',
        "carThree.alphaNum" => '车牌号尾号为字母数字组合',
        "carThree.length"   => '车牌号尾号长度固定为5'
    ];
}