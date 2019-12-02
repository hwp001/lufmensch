<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/2
 * Time: 17:12
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
class Car extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    //修改器
    public function getStateAttr($value)
    {
        $state = [
            0=>'禁用',
            1=>'启用'
        ];
        return $state[$value];
    }

    //获取全部车辆信息
    public function getCars()
    {
        return self::paginate(10);
    }

    //添加车辆信息
    public function add($data)
    {
        return self::create($data);
    }

    //验证车牌号是否存在
    public function findCar($license)
    {
        return self::where('license',$license)->find();
    }

    //车辆预约成功：orderState -》 1 or orderState -》 0
    public function restart($license)
    {
        $data = ['orderState'=>1];
        return self::where('license',$license)->update($data);
    }

    //根据多个id查询多个车辆信息
    public function getCarByIds($data)
    {
        return self::all($data)->toArray();
    }

    //依次根据车牌号查找车辆信息
    public function getCarInfo($licenseArr)
    {
        $carInfo = [];
        foreach($licenseArr as $license) {
            $carInfo[] = self::where([
                'license'=> $license,
                'state'  => 1
            ])->find();
        }
        return $carInfo;
    }

    //根据车牌号改变车牌号状态
    public function updataOrderStateByLicense($license)
    {
        return self::where([
            'state'   => 1,
            'license' => $license
        ])->update(['orderState' => 1]);
    }

}