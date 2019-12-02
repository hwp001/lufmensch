<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 9:15
 */
namespace app\main\controller;
use app\main\controller\Base;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}