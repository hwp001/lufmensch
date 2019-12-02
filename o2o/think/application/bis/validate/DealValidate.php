<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/18
 * Time: 9:09
 */

namespace app\bis\validate;
use think\Validate;

class DealValidate extends Validate
{
    protected $rule = [
        'name' => "require",
        'total_count' => 'require|integer',
        'origin_price' =>  'require|integer',
        'current_price' => 'require|integer',
    ];

    protected $message = [
        'name.require' => '团购名称不能为空',
        'total_count.require'=> '库存数不能为空',
        'origin_price.require'=> '原价不能为空',
        'current_price.require'=> '团购价不能为空',
        'total_count.integer' => '库存数只能为数字',
        'origin_price.integer' => '原价只能为数字',
        'current_price.integer' => '团购价只能为数字',
    ];
}