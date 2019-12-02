<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 18:00
 */

namespace app\common\validate;
use think\Validate;

class AuthValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "name" => "unique:auth",
    ];
    //自定义提示信息
    protected $message = [
        "name.auth" => '权限名称不能重复',
    ];
}