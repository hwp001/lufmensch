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
 * 团购商品分类
 */
class Deal extends Model
{
    protected $status;
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    //根据id 来获取团购商品数据
    public function getDealById($id)
    {
        return self::where("id",$id)->find()->toArray();
    }

    //获取所有团购商品
    public function getAll()
    {
        return self::select()->toArray();
    }

    //获取所有合格的团购商品
    public function getAllPass()
    {
        return self::where('status',1)->select()->toArray();
    }

    //添加数据
    public function add($data)
    {
        return self::create($data);
    }

    //软删除
    public function deleteDeal($id)
    {
        return self::destroy($id);
    }

    //修改状态
    public function updateStatus($id,$status)
    {
        return self::where('id',$id)->update(['status'=>$status]);
    }

    //根据id拿团购商品的数量
    public function getCount($id)
    {
        return self::where('id',$id)->find()->toArray();
    }

    //更新团购订单数量
    public function changeCount($id,$data)
    {
        return self::get($id)->save($data);
    }
}