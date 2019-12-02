<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/14
 * Time: 15:33
 */

namespace app\bis\controller;
use app\bis\controller\Base;
use app\common\model\BisLocation;
use app\common\model\City;
use app\common\model\Category;
use app\bis\validate\LocationValidate;
use Request,Db,Session;

class Location extends Base
{
    //初始界面
    public function index()
    {
        $allBisLocations = (new BisLocation())->getAllBisLocation();
        $this->assign('allBisLocations',$allBisLocations);
        return $this->fetch();
    }

    //添加门店
    public function add()
    {
        //判断是否为post请求
        if (Request::isPost()) {
            $data = Request::param();
            //先获取用户Id
            $uid = Session::get('uid');
            $account = Db::name("bis_account")->field("pid")->where("id",$uid)->find();
            //获取商户ID
            $bis_id = $account["pid"];
            //实例化验证器
            $locationValidate = new LocationValidate();
            if ($locationValidate->check($data)) {
                $bisLocation = new BisLocation();
                $location = [
                    "bis_id" => $bis_id,
                    "name" => $data['name'],
                    "description" => $data['description'],
                    "contact" => $data['contact'],
                    "tel" => $data['tel'],
                    "city_id" =>$data['city_id'],
                    "city_path" =>$data["city_id"].",".$data['se_city_id'],
                    "open_time" => $data['open_time'],
                    "address" => $data["address"],
                    "category_id" => $data['category_id'],
                    "category_path" => $data['category_id'].",". implode('|', $data['se_category_id'])
                ];
                $bid =  $bisLocation->add($location);
                if ($bid) {
                    $this->success("添加成功","location/index");
                }
                $this->error("添加失败");
            }
            //如果验证失败
            $this->error($locationValidate->getError());
        }

            //获取省数据，parent_id = 0;
            $city = new City();
            $province = $city->getFirstCity();

            //获取生活服务分类
            $category = new Category();
            $categorys = $category->getFirstCategory();

            //模板赋值
            $this->assign([
                "province" => $province,
                "categorys" => $categorys,
            ]);

        return $this->fetch();
    }

    //删除店铺
    public function del()
    {
        $id = Request::param('id');
        $rows = (new BisLocation())->deleteLocation($id);
        if ($rows !== false) {
            $this->success('删除店铺成功','location/index');
        }
        $this->error('删除店铺失败');
    }
}