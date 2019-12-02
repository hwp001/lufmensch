<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/2
 * Time: 14:44
 */

namespace app\common\validate;
use think\Validate;

class OilsValidate extends Validate
{
    protected $rule = [
        "name" => "unique:oils"
    ];
    protected $message = [
        "name:unique" => "油品类名不能重复"
    ];
}