<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 15:48
 */
namespace app\common\validate;
use think\Validate;
class RoleValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "name" => "require|unique:role|chs|max:10",
    ];
    //自定义提示信息
    protected $message = [
        "name.require" => "角色名不能为空",
        "name.unique"  => "角色名不能重复",
        "name.chs"      => "角色名只能为汉字",
        "name.max"      => "角色名最大长度为10"
    ];
}