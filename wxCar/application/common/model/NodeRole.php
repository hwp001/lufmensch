<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/2
 * Time: 11:03
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class NodeRole extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    //增加用户和权限
    public function add($data)
    {
        return self::save($data);
    }
}