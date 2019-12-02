<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/11
 * Time: 18:34
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class BisAccount extends Model
{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    public function add($data)
    {
        $bisAccount = self::create($data);
        return $bisAccount->id;
    }

    //根据商户id 获取数据
    public function getAccount($bid)
    {
        return self::where("pid",$bid)->find()->toArray();
    }
}