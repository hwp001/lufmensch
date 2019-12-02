<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/15
 * Time: 9:10
 */

namespace app\main\controller;
use app\main\controller\Base;
use app\common\model\Deal as dea;
use app\common\model\BisLocation;
use app\common\model\Category;
use app\common\model\City;
use Request;
class Deal extends Base
{
    //团购列表
    public function index()
    {
        $dealDatas = (new dea())->getAllPass();
        $this->assign('dealDatas',$dealDatas);
        return $this->fetch();
    }

    //团购提交
    public function send()
    {
        if (Request::isPost()) {
            //获取提交过来的数据
            $data = Request::param();
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
                "start_time" => time($data['start_time']),
                "end_time" => time($data['end_time']),
                "origin_price" => $data['origin_price'],
                "current_price" => $data['current_price'],
                "city_id" => $data['city_id'],
                "buy_count" => 0,  //  创建默认为0
                "total_count" => $data['total_count'],
                "listorder" => 0,  //暂时不知道排序 默认0
                "coupons_begin_time" => time($data['coupons_begin_time']),
                "coupons_end_time"  => time($data['coupons_end_time']),
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
        $dealDatas = (new dea())->getAll();
        $allBis = (new BisLocation)->getAllBisLocation();
        $categorys = (new Category())->getFirstCategory();
        $citys = (new City())->getFirstCity();
        $this->assign([
            "allBis"  => $allBis,
            "categorys" => $categorys,
            "citys"     => $citys,
            "dealDatas" => $dealDatas
        ]);
        return $this->fetch();
    }

    //删除团购商品
    public function del()
    {
        $id = Request::param('id');
        $rows = (new Dea())->deleteDeal($id);
        if ($rows !== false) {
            $this->success('删除团购商品成功','index');
        }
        $this->error('删除团购商品失败');
    }
}