<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 14:53
 */

namespace app\wx\controller;
use app\common\validate\OrderValidate;
use think\Controller;
use app\common\model\Order as Orde;
use app\common\model\Car;
use Request,Db,Session;
class Order extends Controller
{
    //提交预约
    public function sub()
    {
        $data = Request::param();
        $openid = Session::get('openid');
        if (empty($data)){
            $this->error('预约失败，请重新填写');
        }
        if (empty($data['oilC'])){
            $this->error('请选择具体油品类型');
        }
        //判断车牌号是否存在
        $row = (new Car())->findCar($data['carOne'].$data['carTwo'].$data['carThree']);
        if ($row->isEmpty()){
            $this->error('车牌号不存在');
        }
        //判断司机是否预约中，否 可接单 是 不可接单（废除）
//        $rows = (new Orde())->getOrderByOpenid($openid);
//        if ($rows > 0 ) {
//            $this->error('正在预约中，请先完成当前预约，方可接单');
//        }

        //司机预约车辆时间相差不小于3600微秒（1分钟）
        $bool = (new Orde())->judRule($openid,strtotime($data['order_time']));
//        var_dump($bool);
        if (!$bool) {
            $this->error('预约车辆时间不能相近，请重新填写预约时间,谢谢');
        }
        $orderVali = new OrderValidate();
        if ($orderVali->check($data)){
            $data = [
                'oils'        => $data['oilP'].$data['oilC'],
                'license'     => $data['carOne'].$data['carTwo'].$data['carThree'],
                'driverName'  => $data['driverName'],
                'driverPhone' => $data['driverPhone'],
                'company'     => $data['company'],
                'order_time'  => strtotime($data['order_time']),
                'openid'      => $openid
            ];
            $rows = (new Orde())->getLicenseOnOrder($data['license']);
//            var_dump($rows);die;
            if ($rows > 0) {
                $this->error('此车辆已经被提前预约了，请重新填写车牌号');
            }
            Db::startTrans();
            $orderObj = (new Orde())->add($data);
            if ($orderObj !== false) {
                //车辆被预约成功，车辆变为被使用状态
                $rows = (new Car())->restart($data['license']);
                if ($rows !== false) {
                    Db::commit();
                    $this->success('预约成功','Logic/line');
                } else {
                    Db::rollback();
                    $this->error('车辆信息更新失败');
                }
            } else {
                Db::rollback();
                $this->error('预约失败，请重新填写');
            }
        } else {
            $this->error($orderVali->getError());
        }

    }

}