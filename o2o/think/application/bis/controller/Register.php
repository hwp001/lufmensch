<?php
namespace app\bis\controller;
use think\Controller;
use app\common\model\City;
use app\common\model\Category;
use app\bis\validate\BisValidate;
use app\common\model\Bis;
use app\common\model\BisLocation;
use app\common\model\BisAccount;
use think\facade\Request;
use Db;
/**
 * 商户入驻
 * @package app\bis\controller
 */
class Register extends Controller
{
    public function  index()
    {
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

    //添加商户数据
    public function add()
    {
        $data = Request::param();
        //实例化验证器
        $bisVali = new BisValidate();
        if ($bisVali->check($data)) {
            //商品信息基本入库
            $bisData = [
                "name" => $data["name"],
                "logo" => $data["logo"],
                "license_logo" => $data["license_logo"],
                "bank_info" => $data["bank_info"],
                "bank_name" => $data["bank_name"],
                "bank_user" => $data["bank_user"],
                "legalperson" => $data["faren"],
                "legalperson_tel" => $data["faren_tel"],
                "email" => $data["email"],
                "city_id" => $data["city_id"],
                "city_path" => $data["city_id"].",".$data["se_city_id"],
                "description" => $data["description"],
                "status" => 0,
            ];

            //开启事务
            Db::startTrans();
            //实例化商户模型
            $bis = new Bis();
            $bid = $bis->add($bisData);
            if ($bid) {
                //店铺数据入库
                $locationData =  [
                    "bis_id" => $bid,
                    "name" => $data["name"],
                    "description" => $data["description"],
                    "contact" => $data["contact"],
                    "tel" => $data["tel"],
                    "city_id" => $data["city_id"],
                    "city_path" => $data["city_id"].",".$data["se_city_id"],
                    "open_time" => $data['open_time'],
                    "category_id" => $data["category_id"],
                    "category_path" => $data["category_id"].",".implode("|",$data["se_category_id"]),
                    "address" => $data["address"],
                    "is_main" => 1
                ];
                //实例化商户店铺模型
                $bisLocation = new BisLocation();
                $bisLocId = $bisLocation->add($locationData);
                if ($bisLocId) {
                    //账户信息入库
                    $code = random();//自定义随机生成字符串函数
                    $bisAccountData = [
                        "name" => $data["username"],
                        "password" => md5($code.$data["password"]),
                        "code" => $code,
                        "pid" => $bid,
                    ];
                    //实例化商户账户模型
                    $bisAccount = new BisAccount();
                    $bisAccId = $bisAccount->add($bisAccountData);
                    if ($bisAccId) {
                        Db::commit();  //提交事务
                        $this->success('申请成功提交',url("waiting"));
                    } else {
                        Db::rollback();
                    }
                } else {
                    Db::rollback();
                }
            } else {
                Db::rollback();
            }





            //之后自己补充一个事务来操作  超过两张表最好加事务
        }
        //没有通过验证 提示报错信息
        $this->error($bisVali->getError());
    }

    public function waiting()
    {
        return $this->fetch();
    }
}