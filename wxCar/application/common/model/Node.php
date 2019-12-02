<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/2
 * Time: 11:01
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class Node extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    //获取所有管理员
    public function getNodes()
    {
        return self::paginate(10);
    }
    //新增管理员
    public function add($data)
    {
        //返回一个id
        return self::create($data)->id;
    }
}