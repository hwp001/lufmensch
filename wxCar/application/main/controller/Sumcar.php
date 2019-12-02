<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/7
 * Time: 16:58
 */

namespace app\main\controller;
use app\main\controller\Base;
use app\common\model\Car;
use app\common\model\Order;
use app\common\model\Oils;
use Request,Db,Config;
class Sumcar extends Base
{
    //已装
    public function Sumzero()
    {
        $back = $this->sum(0);
        $this->assign([
            'cars'    => $back['carInfos'],
            'dataCar' => $back['dataCar']
        ]);
        return $this->fetch();
    }


    //正在装
    public function Sumone()
    {

        $back = $this->sum(1);
        $this->assign([
            'cars'    => $back['carInfos'],
            'dataCar' => $back['dataCar']
        ]);
        return $this->fetch();
    }

    //厂区内装
    public function Sumtwo()
    {
        $back = $this->sum(2);
        $this->assign([
            'cars'    => $back['carInfos'],
            'dataCar' => $back['dataCar']
        ]);
        return $this->fetch();
    }

    //厂区外装
    public function Sumthree()
    {
        $back = $this->sum(3);
        $this->assign([
            'cars'    => $back['carInfos'],
            'dataCar' => $back['dataCar']
        ]);
        return $this->fetch();
    }

    //添加车辆 已装完
    public function addzero()
    {
        $data = $this->addCar(0,'Sumzero');
        $this->assign([
            'oils'    => $data['oils'],
            'carOnes' => $data['carOnes'],
            'carTwos' => $data['carTwos']
        ]);
        return $this->fetch();
    }

    //添加车辆  正在装
    public function addone()
    {
        $data = $this->addCar(1,'Sumone');
        $this->assign([
            'oils'    => $data['oils'],
            'carOnes' => $data['carOnes'],
            'carTwos' => $data['carTwos']
        ]);
        return $this->fetch();
    }

    //添加车辆  厂区待装
    public function addtwo()
    {
        $data = $this->addCar(2,'Sumtwo');
        $this->assign([
            'oils'    => $data['oils'],
            'carOnes' => $data['carOnes'],
            'carTwos' => $data['carTwos']
        ]);
        return $this->fetch();
    }

    //添加车辆 厂外待装
    public function addthree()
    {
        $data = $this->addCar(3,'Sumthree');
        $this->assign([
            'oils'    => $data['oils'],
            'carOnes' => $data['carOnes'],
            'carTwos' => $data['carTwos']
        ]);
        return $this->fetch();
    }


    //公共模块 添加车辆（已装完 正在装 厂区待装 厂外待装）
    public function addCar($orderState,$url)
    {
        var_dump($orderState);
        if ($orderState == 1 || $orderState == 2) {
            //验证此状态是否已经存在
            $res = (new Order())->getCarLicsense($orderState);
            //此状态是否有车辆存在   返回结果集对象 用$res->isEmpty()  不用empty($res)
            if (!($res->isEmpty())) {
                $this->error('此状态有且只有一个，不可添加，谢谢配合');
            }
        }
        if (Request::isPost()){
            $data = Request::param();
            //验证车牌号是否存在
            $license = $data['carOne'].$data['carTwo'].$data['carThree'];
            $row = (new Car())->findCar($license);
            //验证车牌号是否已经在订单中
            $num = (new Order())->getOrderByLicense($license);
            if ($num > 0 ){
                $this->error('车牌号已存在订单中，请重新填写');
            }
//            var_dump($row);die;
            if (!empty($row)) {
                //开启事务  在订单添加车辆的同时 需要将车辆启用状态 改为1
                Db::startTrans();
                $data = [
                    'driverName' => $data['driverName'],
                    'driverPhone'=> $data['driverPhone'],
                    'oils'       => $data['oilP'].$data['oilC'],
                    'order_time' => strtotime($data['order_time']),
                    'license'    => $license,
                    'orderState' => $orderState
                ];
                $row = (new Order())->add($data);
                if ($row !== false){
                    $row = (new Car())->updataOrderStateByLicense($license);
                    if ($row !== false) {
                        Db::commit();
                        $this->success('车辆添加成功',$url);
                    } else {
                        Db::rollback();
                        $this->error('车辆状态改变失败');
                    }
                } else {
                    Db::rollback();
                    $this->error('车辆添加失败');
                }
            }else {
                Db::rollback();
                $this->error('车牌号不存在');
            }
        }
        $oils =  (new Oils())->getPid();
        $carOnes = config::get('license.carOne');
        $carTwos = config::get('license.carTwo');
        $data = [
            'oils'    => $oils,
            'carOnes' => $carOnes,
            'carTwos' => $carTwos
        ];
        return $data;

    }


    //公共模块  显示初始页面
    public function sum($orderState)
    {
        $dataCar = '';
        //模糊查询
        if (Request::param('key')){
            $data = Request::param();

            if (empty($data)){
                $dataCar = 'noInfo';
            }
            //模糊查找所有已完成的预约
            $sql = "select license from vehicle_order where state = 1 and orderState = ".$orderState." and license like '%".$data['key']."%'";
            $licenseArr = Db::query($sql);
            if (!$licenseArr) {
                $dataCar = 'noInfo';
            }
//            var_dump($licenseArr);die;
        }else {
            //查找所有已完成的预约
            $licenseArr = (new Order())->getCarLicsense($orderState)->toArray();
            if (!$licenseArr) {
                $dataCar = 'noInfo';
            }
        }
//        var_dump($licenseArr);die;
        $carInfos = (new Car())->getCarInfo($licenseArr);
        if (!$carInfos) {
            $dataCar = 'noInfo';
            $carInfos->toArray();
        }
        $back = [
            'dataCar'  => $dataCar,
            'carInfos' => $carInfos
        ];
        return $back;
    }

}