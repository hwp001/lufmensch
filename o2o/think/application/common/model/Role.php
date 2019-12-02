<?php

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
/**
 * 角色模型
 * @package app\common\model
 */
class Role extends Model
{
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;   //再数据库中，要设置一个·
    //自动写入时间戳
    protected $autoWriteTimestamp = true;

    //添加角色数据
    public function add($data)
    {
        $roleObj =  self::create($data);
        return $roleObj->id;
    }

    //获取角色列表
    public function getRoleList()
    {
        return self::select()->toArray();
    }

    //获取全部角色
    public function getAllRole()
    {
        return self::select()->toArray();
    }
}