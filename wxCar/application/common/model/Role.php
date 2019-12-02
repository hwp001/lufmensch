<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 15:54
 */

namespace app\common\model;
use think\model\concern\SoftDelete;
use think\Model;

class Role extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

   //获取所有角色
    public function getRoles()
    {
        return self::paginate(10);
    }

    //增加角色
    public function add($data)
    {
        return self::create($data);
    }

    //获取所有权限分配的角色
    public function getRoleHaveAuths()
    {

    }
}