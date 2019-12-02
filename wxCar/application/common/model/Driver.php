<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/3
 * Time: 11:14
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class Driver extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    //获取所有司机信息
    public function getDrivers()
    {
       return self::paginate();
    }

    //新增司机信息
    public function add($data)
    {
        return self::save($data);
    }

    //根据openid 在同一个公众号唯一 查询司机信息
    public function getInfoByOpenId($openid)
    {
        return self::where('openid',$openid)->find();
    }

    //根据openid 获取被拉黑的司机
    public function getBlackInfoByOpenId($openid)
    {
        return self::where([
            "openid" => $openid,
            "state"  => 0
        ])->count();
    }

    //根据openid 获取司机信息
    public function getDriver($openid)
    {
        return self::where('openid',$openid)->find()->toArray();
    }

    //根据openid 更改司机信息
    public function updateInfoByOpenId($openid,$data)
    {
       //返回模型对象实例
        return self::where('openid',$openid)->update($data);
    }

    //根据openid 和 车牌号 判断是否其他司机已经注册了此车牌号
    public function verifyLicenseByopenid($openid,$license)
    {
        return self::where('license',$license)->where('openid','<>',$openid)->count();
    }
}