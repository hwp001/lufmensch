<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/11
 * Time: 22:01
 */

namespace app\main\controller;
use app\main\controller\Base;
use think\facade\Request;
use app\common\model\Bis as Bi;
use app\common\model\City;
use app\common\model\BisLocation;
use app\common\model\BisAccount;
use app\common\model\Category;
use app\main\controller\Mail;
/**
 * 商户管理
 * @package app\main\controller
 */
class Bis extends Base
{
    //获取商户申请列表
    public function apply()
    {
        //获取所有申请的商户
        $bisData = (new Bi())->getAll();
        $this->assign("bisData",$bisData);
        return $this->fetch();
    }

    //获取商户的详情数据
    public function detail()
    {
        $bid = Request::param("id");
        //商户的基本数据
        $bisData = (new Bi())->getBis($bid);
        //获取省份
        $proId = $bisData["city_id"];
        $province = (new City())->getCityById($proId);
        //获取市
        $cityPath =explode(",",$bisData["city_path"]);
        $cityId = end($cityPath);
        $city = ((new City()))->getCityById($proId);
        $bisData["province"] = $province["name"];
        $bisData["city"] = $city["name"];
        //商户总店的数据
        $bisLocationData = (new BisLocation())->getBisLocationBybid($bid,1);
        //获取顶级分类得id
        $cateId = $bisLocationData['category_id'];
        $category = ((new Category())->getCategoryById($cateId));
        //获取子分类
        $subCatePath =  explode(",",$bisLocationData['category_path']);
        $subCateId = end($subCatePath);
        $subCategory = ((new Category())->getCategoryById($subCateId));
        $bisLocationData['category'] = $category["name"];
        $bisLocationData['subCategory'] = $subCategory["name"];

        //获取商户账户得数据
        $bisAccountData = (new BisAccount())->getAccount($bid);

        //模板赋值
        $this->assign([
            "bisData" =>  $bisData,
            "bisLocationData" => $bisLocationData,
            "bisAccountData" => $bisAccountData,
        ]);

        return $this->fetch();
    }

        //判断商户数据是否合格
        public function isStandard()
        {

            //状态
            $status = Request::param("status");
            //商户id
            $bid = Request::param("bid");
            //关联模型同时修改商户表，和账户表
            $bis = Bi::get($bid);
            $bis->status = $status;
            //bisAccount 模型中的bisAccount方法,表示bis关联模型中的status属性
            $bis->bisAccount->status = $status;
            $res = $bis->together('bisAccount')->save();

            if ($res) {
                //实例化邮件发送类
                 $mail = new Mail();
                 $subject = "商户审核结果";   //邮件的标题
                if ($status == 1) {
                    $body = "<p style='color:green'>恭喜！！！审核通过</p><p>o2o团购</p>";
                } else {
                    $body = "<p style='color:red'>抱歉！！！审核失败</p><p>o2o团购</p>";
                }
                $reciver = [
                    "hwp" => "hwpoo1@163.com",
                ];
                $mail->send($subject, $body, $reciver);
                return json(["code"=>1]);
            } else {
                return json(["code" => 0]);
            }
        }


        //商户列表
        public function index()
        {
            //获取所有申请的商户
            $bisData = (new Bi())->getAll();
            $this->assign("bisData",$bisData);
            return $this->fetch();
        }

        //删除的商户
        public function dellist()
        {
            //只获取被删除的商户
            $bisData = (new Bi())->delData();
            $this->assign("bisData",$bisData);
            return $this->fetch();
        }
}