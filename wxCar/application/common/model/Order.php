<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 17:53
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
class Order extends Model
{
    use SoftDelete;    //引用软删除
    protected $delete_time = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    //添加订单
    public function add($data)
    {
        return self::create($data);
    }

    //查找车辆在预约中并处于四个车辆状态
    public function getLicenseOnOrder($license)
    {
        return self::where('license',$license)->where('orderState',"IN","1,2,3,4")->where('state',1)->count();
    }

    //查找司机是否预约中
    public function getOrderByOpenid($openid)
    {
        return self::where([
            'openid' => $openid,
            'state'  => 1
        ])->where('orderState','IN',"1,2,3,4")->count();
    }

    //查找车牌号是否预约中
    public function getOrderByLicense($license)
    {
        return self::where([
            'license' => $license,
            'state'  => 1
        ])->where('orderState','IN',"1,2,3,4")->count();
    }


    //查找司机上次一条预约的时间和这次预约的时间相差是否在规定时间内
    public function judRule($openid,$order_time)
    {
        $result = self::where([
            'openid' => $openid,
            'state'  => 1
        ])->order(['id'=>'desc'])->find();
        //判断当前预约时间 是否大于 最近一次预约时间 + 3600
        if ($order_time >= ($result['order_time']) + 3600){
            return true;
        } else {
            return false;
        }
    }

    //根据openid 查看当前订单司机信息
    public function getInfoByOpenId($openid)
    {
        return self::where([
            'openid' => $openid,
            'state'  => 1
        ])->where('orderState','IN',"1,2,3,4")->order(['orderState','order_time'])->find();
    }

    //根据openid 查看司机预约成功的订单
    public function getOrdersByOpenId($openid)
    {
        return self::where([
            'openid' => $openid,
            'state'  => 1
        ])->order(['orderState','order_time'])->select();
    }

    //查找全部预约成功车辆
    public function getOrders()
    {
        return self::where('state',1)->order(['orderState','order_time'])->select();
    }

    //模糊搜索 车牌号 油品类型 状态(后期补)
    public function dimOrder($data)
    {
        return self::where('state',1)
            ->where('license','LIKE','%'.$data['license'].'%')
            ->where('oils','LIKE','%'.$data['oils'].'%')
            ->select();
    }

    //根据状态获取车辆信息
    public function getCarLicsense($orderState)
    {
        return self::field('license')->where([
            'orderState' => $orderState,
            'state'      => 1
        ])->group('license')->select();
    }

    //根据状态模糊获取车辆信息
    public function getCarLicsenseLike($orderState,$like)
    {
        return self::field('license')->where([
            'orderState' => $orderState,
            'state'      => 1
        ])->where('license','LIKE',$like)->group('license')->select();
    }

    //查找处于四个状态中的全部车辆 并且按照 orderState order_time 排序
    public function getCarInfoOnStates()
    {
        return self::where('state',1)
            ->where('orderState','IN','1,2,3,4')
            ->order('orderState','order_time')
            ->paginate();
    }
    //查找处于四个状态中的全部车辆 并且按照 orderState order_time 排序
    public function getCarInfoOnState()
    {
        return self::where('state',1)
            ->where('orderState','IN','1,2,3,4')
            ->order('orderState','order_time')
            ->select();
    }

    //根据车牌号找到订单id
    public function getIdBylicense($license)
    {
        return self::field('id')->where([
            'state'   => 1,
            'license' => $license
        ])->find();
    }

    //判断 正在装车 厂内待装 厂外待装 同一时刻有且一个
    public function verifyOrderState($license,$orderState){
        return self::where('license','<>',$license)
            ->where('orderState','IN','1,2,3')
            ->where('orderState',$orderState)
            ->find();
    }

    //根据车牌号更新车辆状态
    public function updateOrderState($license,$orderState)
    {
        $data = [
            'orderState'   => $orderState,
            'update_time' => time()
        ];
        return self::where([
            'state'       => 1,
            'license'     => $license,
        ])->update($data);
    }

}