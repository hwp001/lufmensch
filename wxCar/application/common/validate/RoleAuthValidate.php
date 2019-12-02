<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 22:13
 */

namespace app\common\validate;
use think\Validate;

class RoleAuthValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "roleId" => "unique:roleAuth",
    ];
    //自定义提示信息
    protected $message = [
        "roleId.unique" => '此角色权限已经分配'
    ];
}