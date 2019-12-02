<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/18
 * Time: 20:50
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
class Test extends Model
{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    public function getAll()
    {
        return self::select()->toArray();
    }
}