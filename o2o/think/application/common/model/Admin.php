<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
/**
 * 管理员模型
 * @package app\common\model
 */
class Admin extends Model
{
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    //自动写入时间戳
    protected $autoWriteTimestamp = true;

    //添加数据
    public function add($data)
    {
       $userObj = self::create($data)->id;
       return $userObj;
    }
}