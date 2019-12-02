<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/16
 * Time: 10:43
 */

namespace app\home\validate;
use think\Validate;

class RegisterValidate extends Validate
{
    //设置规则  暂时是一个一维数组
    protected $rule = [
        'username' => 'require|unique:member',
        'code' => 'require',
        'mobile' => 'unique:member',
        'password' => 'require',
        'repassword' => 'confirm:password'
    ];
    //错误提示信息
    protected $message = [
        'username.require' => '用户名不能为空',
        'username.unique'  => '用户名已经存在',
        'code.require' => '邮箱不能为空',
        'mobile.unique' => '手机号已存在',
        'password.require' => '密码必须',
        'repassword.require' => '确认密码和密码必须一致',
   ];
}