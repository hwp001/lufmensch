<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/14
 * Time: 17:53
 */

namespace app\bis\controller;
use app\bis\controller\Base;
use app\common\model\Category;
use app\common\model\City;
use app\common\model\BisLocation;
use app\common\model\BisAccount;
use app\bis\validate\DealValidate;
use app\common\model\Deal as dea;
use Request,Session;

/**
 * 团购商品后台
 * @package app\bis\controller
 */
class Deal  extends Base
{
    //团购商品列表
    public function index()
    {
        $dealDatas = (new dea())->getAll();
        $this->assign('dealDatas',$dealDatas);
        return $this->fetch();
    }
    //添加团购商品
    public function add()
    {
        if (Request::isPost()) {
            //获取提交过来的数据
            $data = Request::param();
            //验证团购日期
            $startTime = strtotime($data['start_time']);
            $endTime =  strtotime($data['end_time']);
            $cbTime =  strtotime($data['coupons_begin_time']);
            $ceTime =  strtotime($data['coupons_end_time']);
            //验证团购价不能比原价高
            $originPrice = $data['origin_price'];
            $currentPrice = $data['current_price'];
            if ($currentPrice > $originPrice) {
                $this->error('团购价不能比原价高');
            }
            if ($endTime < $startTime) {
                $this->error('团购结束时间不能在团购开始时间之前');
            } else if($cbTime > $endTime && $cbTime < $startTime) {
                $this->error('团购券生效时间不能再团购开始之前或者团购券生效时间不能再团购时间开始之后');
            }

//            var_dump($startTime);
//            var_dump($endTime);
//            var_dump($cbTime);
//            var_dump($ceTime);die;

            $dealVali = new DealValidate();
            if ($dealVali->check($data)) {
                //通过session 来找到商户账号Id 还有所属商户Id
                $accountId = Session::get('uid');
                $bisAccount = (new BisAccount())->getAccount($accountId);
                $bisId = $bisAccount['pid'];
                //将数组拼成字符串
                $location_ids = implode(',', $data['location_ids']);
                $se_category_id = implode(',', $data['se_category_id']);
                //准备更新数据
                $dealData = [
                    "name"    =>  $data['name'],
                    "category_id" => $data['category_id'],
                    "se_category_id" => $data['se_category_id'],
                    "bis_id" => $bisId,
                    "location_ids" => $location_ids,
                    "image"  => $data['image'],
                    "description" => $data['description'],
                    "start_time" => $startTime,
                    "end_time" => $endTime,
                    "origin_price" => $data['origin_price'],
                    "current_price" => $data['current_price'],
                    "city_id" => $data['city_id'],
                    "city_path" => $data['city_id'].','.$data['se_city_id'],
                    "buy_count" => 0,  //  创建默认为0
                    "total_count" => $data['total_count'],
                    "listorder" => 0,  //暂时不知道排序 默认0
                    "coupons_begin_time" => $cbTime,
                    "coupons_end_time"  => $ceTime,
                    "status" => 0,  //0   默认待审
                    "bis_account_id" => $accountId,
                    "balance_price" => $data['origin_price'] * 0.6, //默认原价六成
                    "notes" => $data['notes'],
                ];
                $res = (new dea())->add($dealData);
                if ($res) {
                    $this->success("添加成功","deal/index");
                }
                $this->error('添加失败');
            }
            $this->error($dealVali->getError());
        }
        $pid = Session::get('pid');
        $allBis = (new BisLocation)->getBisLocationById($pid);
        $categorys = (new Category())->getFirstCategory();
        $citys = (new City())->getFirstCity();
        $this->assign([
            "allBis"  => $allBis,
            "categorys" => $categorys,
            "citys"     => $citys
        ]);
        return $this->fetch();
    }

    //团购商品详情
    public function detail()
    {
        $did = Request::param("id");
        $locationIds = Request::param("locationIds");
        //获取支持门店
        $Lids = explode(',',$locationIds);
        $locations = (new BisLocation())->getNameByIds($Lids);
        //团购商品的基本数据
        $dealData = (new dea())->getDealById($did);
        //获取省份
        $proId = $dealData["city_id"];
        $province = (new City())->getCityById($proId);
        //获取市
        $cityPath =explode(",",$dealData["city_path"]);
        $cityId = end($cityPath);
        $city = ((new City()))->getCityById($proId);
        $dealData["province"] = $province["name"];
        $dealData["city"] = $city["name"];
        //获取顶级分类得id
        $cateId = $dealData['category_id'];
        $category = ((new Category())->getCategoryById($cateId));
        $dealData['category'] = $category["name"];

        //模板赋值
        $this->assign([
            "locations" => $locations,
            "dealData" =>  $dealData,
        ]);

        return $this->fetch();
    }

    //软删除
    public function del()
    {
        $id = Request::param('id');
        $rows = (new dea())->deleteDeal($id);
        if ($rows !== false) {
            $this->success('删除成功','deal/index');
        }
        $this->error('删除失败');
    }
}