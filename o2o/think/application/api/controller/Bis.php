<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/11
 * Time: 15:18
 */

namespace app\api\controller;
use Request,Db;
use think\Controller;

class Bis extends Controller
{
    public function getBisName()
    {
        $name = Request::param("name");
        $row = Db::name("bis")->field("name")->where("name",$name)->find();
        if ($row) {
            return json(["status" => 0]);
        } else {
            return json(["status" => "1"]);
        }
    }
}