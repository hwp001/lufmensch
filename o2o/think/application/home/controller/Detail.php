<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/16
 * Time: 21:26
 */

namespace app\home\controller;
use think\Controller;
use Request,Session;
use app\common\model\Deal;
/*
 * 商品详情页
 */
class Detail extends Controller
{
    //显示详情页面
    public function index()
    {
        //获取商品的id
        $dealId = Request::param('id');
        //获取商品数据
        $deals = (new Deal())->getDealById($dealId);
        //获取到开始的时间
        $startTime = $deals["start_time"];
        $flag = 0;   //还没开始
        if ($startTime < time()) {
            $flag = 1;
        }
        $time = $deals['end_time'] - time();  //团购的时间段
        $timedata = "";
        $d = floor($time/(3600*24));  //floor 去除小数点
        $h = floor($time%(3600*24)/3600);
        $m = floor($time%(3600*24)%3600/60);
        $timedate = ['d'=>$d,'h'=>$h,'m'=>$m];
        $this->assign('timedate',$timedate);
        $this->assign('deals',$deals);
        return $this->fetch();
    }
}