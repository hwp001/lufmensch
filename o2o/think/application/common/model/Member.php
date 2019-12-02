<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
/**
 * 会员模型
 * @package app\common\model
 */
class Member extends Model
{
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    //自动写入时间戳
    protected $autoWriteTimestamp = true;

    public function add($data)
    {
        return self::create($data)->id;
    }
}