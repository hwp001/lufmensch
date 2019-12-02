<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 9:58
 */

namespace app\wx\controller;
use app\wx\controller\Base;

class Advertise extends Base
{
    //关于我们页面
    public function index()
    {
        return $this->fetch();
    }

    //联系我们
    public function contract()
    {
        return $this->fetch();
    }
}