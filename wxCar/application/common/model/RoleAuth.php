<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 22:17
 */
namespace app\common\model;
use think\model\concern\SoftDelete;
use think\Model;

class RoleAuth extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    //批量增加角色权限
    public function addRoleAuths($data)
    {
        return self::saveAll($data);
    }

    //查看角色权限是否已分配
    public function find($roleId)
    {
        return self::where('roleId',$roleId)->find();
    }

}