<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/7
 * Time: 13:35
 */

namespace app\common\model;

use think\model\concern\SoftDelete;
use think\Model;

class Code extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    public function savaCode($data)
    {
        return self::saveAll($data);
    }
}