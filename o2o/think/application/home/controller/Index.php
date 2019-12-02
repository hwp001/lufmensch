<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/15
 * Time: 22:46
 */

namespace app\home\controller;
use think\Controller;
use app\common\model\Category;
use app\common\model\City;
use Db;
class Index extends Controller
{
   //显示首页
    public function index()
    {
        //先获取顶级分类的数据
        $categorys = (new Category())->getFirstCategory()->toArray();
        foreach ($categorys as $category) {
            $ids[] = $category["id"];
        }
        //根据顶级分类的主键id 获取子分类的数据集
        $subCategorys = (new Category())->getCategoryByIds($ids)->toArray();

        foreach($subCategorys as $subCategory) {
            $subCategoryArr[$subCategory["parent_id"]][] = [
                "id" => $subCategory["id"],
                "name" => $subCategory["name"]
            ];
        }

        foreach($categorys as $category) {
            $allCategorys[] = [$category["name"],empty($subCategoryArr[$category["id"]])?[]:$subCategoryArr[$category["id"]]];
        }

        //获取长沙 团购的商品
        $city = "changsha";
        $city = (new  City())->getIdByCityName($city);
        $cityPath = $city["parent_id"].",".$city["id"];  //用城市的地址链和团购商品的地址链 进行比较 来筛选出商品
        //获取长沙 餐饮 这个类目的商品
        $deals = Db::name('deal')->field("id,name,description,origin_price,current_price,buy_count,image")->where([
            "status" => 1,
            "city_path" => $cityPath
        ])->select();
        $this->assign("deals",$deals);
        $this->assign('allCategorys',$allCategorys);
        return $this->fetch();
    }
}








