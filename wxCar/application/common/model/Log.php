<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 10:35
 */
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
class Log extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    //获取全部日志
    public function getLogs()
    {
        return self::paginate(2);
    }

    //删除日志
    public function delLog($id)
    {
        return self::get($id)->delete();
    }

}