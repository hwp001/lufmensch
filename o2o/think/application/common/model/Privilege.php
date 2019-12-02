<?php

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
/**
 * 权限模型
 * @package app\common\model
 */
class Privilege extends Model
{
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;   //再数据库中，要设置一个·
    //自动写入时间戳
    protected $autoWriteTimestamp = true;

    //添加权限的数据
    public function add($data)
    {
        self::create($data);
        return true;
    }

    //获取有层级的分类
    public function getTreePrivilege()
    {
        $data = self::select()->toArray();
        return getTree($data);
    }

    //获取全部权限分类
    public function getall()
    {
        return self::select()->toArray();
    }
}