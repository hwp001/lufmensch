<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/14
 * Time: 23:11
 */

namespace app\common\model;
use think\model\concern\SoftDelete;
use think\Model;

/*
 * 订单处理逻辑
 */
class Order extends Model
{
    protected $status;
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    //添加订单
    public function add($data)
    {
        //返回订单id
        return self::create($data)->id;
    }

    //根据订单id 获取订单数据
    public function getOrder($oid)
    {
        return self::where("id",$oid)->find()->toArray();
    }

}