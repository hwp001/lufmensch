<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/9/29
 * Time: 11:46
 */

namespace app\index\controller;
use app\common\controller\Base;
use app\common\model\User;

class Test extends Base
{
    public function test1()
    {
        $data = [
            'name' => 'peter',
            'email' => 'peter@php.cn',
            'mobile' => '18911111111',
            'password' => '123abcd'
        ];
        $rule = 'app\common\validate\User';
        return $this->validate($data, $rule);
    }
    public function test2()
    {
        $res = User::get(25);
        dump($res);
        dump ($res->name);
    }
}