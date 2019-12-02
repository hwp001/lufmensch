<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 11:51
 */

namespace app\common\validate;
use think\Validate;

class DriverValidate extends Validate
{
    //自定义规则
    protected $rule = [
        "trueName"    => "require|chs",
        "license"  => "require",
        "Three"       => "require|alphaNum|length:5"
    ];
    //自定义提示信息
    protected $message = [
        "trueName.require"   => "姓名不能为空",
        "trueName.chs"       => "姓名格式错误",
        "carLicense.require" => '必须填写车牌号',
        "carLicense.unique"  => '车牌号不能重复,并且存在',
        "Three.require"      => '尾号必须填写',
        "Three.alphaNum"     => '尾号格式有误',
        "Three.length"       => '尾号长度为五位'
    ];
}