<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/3
 * Time: 11:09
 */

namespace app\main\controller;
use app\main\controller\Base;
use app\common\model\Driver as Drive;
class Driver extends Base
{
    //司机初始页面
    public function index()
    {
        $drivers = (new Drive())->getDrivers();
        $this->assign([
            'drivers' => $drivers
        ]);
        return $this->fetch();
    }
}