<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/2
 * Time: 14:19
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class Oils extends Model
{
    use SoftDelete;    //引用软删除
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;
    protected $autoWriteTimestamp = true;   //自动写入时间戳

    // 默认获取顶级分类
    public function getPid($pid = 0)
    {
        return self::where('pid', $pid)->select()->toArray();
    }

    //添加油品分类
    public function add($data)
    {
        return self::create($data);
    }

    //获取全部油品非顶级分类
    public function getOils()
    {
        return self::where('pid','<>',0)->select()->toArray();
    }

    //根据pid 获取父类名字
    public function getOilsFa($pid)
    {
        $result = self::where('id',$pid)->find()->toArray();
        return $result['name'];
    }

    //根据油品父类获取子类
    public function getChildByParentName($name)
    {
        $result = self::where('name',$name)->find()->toArray();
        return  $this->getPid($result['id']);
    }



}