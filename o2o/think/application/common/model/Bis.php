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

class Bis extends Model
{
    protected $status;
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    //添加入驻商家
    public function add($data)
    {
        $bis = self::create($data);
         return $bis->id;
    }

    //获取所有申请的商户
    public function getAll()
    {
        return self::paginate(5);
    }

    //根据商户id 来获取数据
    public function getBis($bid)
    {
        return self::where("id",$bid)->find()->toArray();
    }

    //根据主键更新数据
    public function updateBis($bid,$status)
    {
        return self::where("id",$bid)->update(["status" => $status]);
    }

    //关联账户模型  模型的命名是关联的那个模型的名字
    public function bisAccount()
    {
        return $this->hasOne("BisAccount", "pid");         //正向关联
    }

    //获取所有被删除的商户
    public function delData()
    {
        return self::onlyTrashed()->select()->toArray();
    }
}