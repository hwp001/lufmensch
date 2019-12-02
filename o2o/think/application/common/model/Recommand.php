<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/15
 * Time: 10:54
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
class Recommand extends Model
{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    //添加数据
    public function add($data)
    {
        return self::create($data)->toArray();
    }
}