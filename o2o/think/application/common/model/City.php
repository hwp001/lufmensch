<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/9
 * Time: 22:52
 */

namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;

class City extends Model
{
    //设置软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;   //再数据库中，要设置一个·

    //自动写入时间戳
    protected $autoWriteTimestamp = true;

    //添加数据
    public function add($data)
    {
        self::create($data);   //模型机制，添加不成功会直接报错
        return true;
    }

    //获取城市分类数据
    public function getFirstCity($id=0,$isPage = false)
    {
        if ($isPage) {
            return self::where("parent_id",$id)->paginate(2);
        }
        return self::where("parent_id",$id)->select();
    }

    //获取有层级的分类
    public function getTreeCity()
    {
        $data = self::select()->toArray();
        return getTree($data);
    }

    //更新数据
    public function updateStatus($id,$status)
    {
        $rows = self::where("id",$id)->update(["status"=>$status]);
        //数据库更新操作中，更新0行也算更新成功
        if ($rows !== false) {
            return true;
        }
        return false;
    }

    //根据分类的id获取分类的数据
    public function getCityById($id)
    {
        return self::where("id",$id)->find()->toArray();
    }

    //更新数据
    public function updateCity($data)
    {
        return $this->get($data['id'])->save($data);
//        return self::update($data);
    }

    //软删除数据
    public function delCity($id)
    {
        return self::destroy($id);
    }

    //根据店铺英文名称来获取城市id
    public function getIdByCityName($name)
    {
        return $city = self::where("alias",$name)->find()->toArray();
    }

}