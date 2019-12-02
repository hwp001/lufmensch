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
use app\common\model\Category as Cate;
/**
 * 生活服务管分类api
 * @package app\main\controller
 */
class Category extends Controller
{
    public function getCategory()
    {
        $cid = Request::param("id");
        //实例化生活分类模型
        $cate = new Cate();
        $categorys = $cate->getFirstCategory($cid)->toArray();
        return json([
            "status" => 1,
            "data" => $categorys,
        ]);
    }

    public function index()
    {
        return "hello,this is test";
    }
}