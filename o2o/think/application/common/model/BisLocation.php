<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/11
 * Time: 18:34
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class BisLocation extends Model
{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    public function add($data)
    {
        $bisLocation = self::create($data);
        return $bisLocation->id;
    }

    //通过Id获取店铺信息 当$isMain = 1 总店 $isMain = 0 分店
    public function getBisLocation($bid,$isMain)
    {
        return self::where([
            "id" => $bid,
            "is_main" => $isMain
        ])->find()->toArray();
    }

    //根据商户Id,isMain获取店铺的信息 当$isMain = 1 总店 $isMain = 0 分店
    public function getBisLocationBybid($bid,$isMain)
    {
        return self::where([
            "bis_id" => $bid,
            "is_main" => $isMain
        ])->find()->toArray();
    }

    //通过商户Id获取店铺信息
    public function getBisLocationById($bid)
    {
        return self::where([
            "bis_id" => $bid
        ])->select()->toArray();
    }

    //获取所有店铺信息
    public function getAllBisLocation()
    {
        return self::select()->toArray();
    }

    //根据多个主键id 获取门店
    public function getNameByIds($ids)
    {
        return self::field('name')->where([
            'id' => $ids,
        ])->select()->toArray();
    }

    //删除门店
    public function deleteLocation($id)
    {
        return self::destroy($id);
    }

}