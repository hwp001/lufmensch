<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 17:56
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class Auth extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳
    //获取全部权限
    public function getAuths()
    {
        return self::paginate(10);
    }

    //权限添加
    public function add($data)
    {
        return self::create($data);
    }

}