<?php
namespace app\common\model;
use think\Model;
use think\model\concern\SoftDelete;
/**
 * 生活服务分类模型
 * @package app\common\model
 */
class Category extends Model
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
        $data['status'] = 1;
        self::create($data);   //模型机制，添加不成功会直接报错
        return true;
    }

    //获取分类数据
    public function getFirstCategory($id=0,$isPage = false)
    {
        if ($isPage) {
            return self::where("parent_id",$id)->paginate(5);
        }
        return self::where("parent_id",$id)->select();
    }

    //获取有层级的分类
    public function getTreeCategory()
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
    public function getCategoryById($id)
    {
        return self::where("id",$id)->find()->toArray();
    }

    //测试
    public function getCateByIds($id)
    {
        return self::where('id',$id)->find()->toArray();
    }

    //更新数据
    public function updateCategory($data)
    {
        return $this->get($data['id'])->save($data);
//        return self::update($data);
    }

    //软删除数据
    public function delCategory($id)
    {
        return self::destroy($id);
    }

    //根据多个主键id 来获取数据
    public function getCategoryByIds($ids)
    {
        return self::where([
            "parent_id" => $ids
        ])->select();
    }


}









