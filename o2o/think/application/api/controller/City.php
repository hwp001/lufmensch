<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/9
 * Time: 22:36
 */

namespace app\api\controller;
use think\Controller;
use think\facade\Request;
use app\common\model\City as Cit;
/**
 * 城市管理分类api
 * @package app\main\controller
 */
class City extends Controller
{
    public function getCity()
    {
        $pid = Request::param("id");
        //实例化城市模型
        $city = new Cit();
        $citys = $city->getFirstCity($pid)->toArray();
        return json([
        "status" => 1,
        "data" => $citys,
    ]);
    }

    public function index()
    {
        return "hello,this is test";
    }
}