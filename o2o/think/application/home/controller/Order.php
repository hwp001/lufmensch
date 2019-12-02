<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/17
 * Time: 9:21
 */

namespace app\home\controller;
use think\Controller;
use Request,Session,Db;
use app\common\model\Deal;
use app\common\model\Order as Orde;
//处理订单业务逻辑
class Order extends Controller
{
    //显示订单页面
    public function index()
    {
       //接受请求数据
        $bid = Request::param('bid');
        $count = Request::param('count');

        //获取商品数据
        $deal = (new Deal())->getDealById($bid);
        $totalPrice = $deal["current_price"]*$count;    //计算总价格
         //模板赋值和渲染
        $this->assign([
            "count" => $count,
            "deal"  => $deal,
            "totalPrice" => $totalPrice,
        ]);

        return $this->fetch();
    }

    //添加订单
    public function add()
    {
        //判断用户是否登录
        if (!Session::has('mid')) {
            $this->redirect("login/index");
            die;
        }
        //获取用户名称 用户id
        $username = Session::get("mname");
        $userId = Session::get('mid');

        //获取 商品id 数量 总额
        $bid = Request::param("bid");
        $count = Request::param("count");
        $totalPrice = ltrim(Request::param("totalPrice"),'¥');
        $price = Request::param('price');

        //计算当前团购商品剩余数量，销量
         $counts = (new Deal())->getCount($bid);
         $buyCount = $counts['buy_count'] + $count;
         $totalCount = $counts['total_count'] - $count;

        //生成订单编号 创建一个算法保证订单唯一
        $orderTradeNo = order_trade_on();
        //构建订单的数据
        $data = [
            "out_trade_no" => $orderTradeNo,
            "user_id" => $userId,
            "username" => $username,
            "deal_id" => $bid,
            "deal_count" => $count,
            "pay_status" => 0,
            "total_price" => $count * $price,
            "pay_amount" => $totalPrice,
         ];
        $dealDatas = [
            'buy_count' => $buyCount,
            'total_count' => $totalCount
        ];
        //添加数据 同时将优惠卷的数量减一
        Db::startTrans();
        $oid = (new Orde())->add($data);
        if ($oid !== false ) {
            $rows = (new Deal())->changeCount($bid,$dealDatas);
            if ($rows !== false) {
                Db::commit();
                $this->success("添加订单成功",url('order/orderSuccess',["oid"=>$oid]));
            } else {
                Db::rollback();
            }
        } else {
            Db::rollback();
        }

        $this->error("添加订单失败");

    }

    //订单支付完成
    public function orderSuccess()
    {
        //订单编号
        $oid = Request::param('oid');

        $order = (new Orde())->getOrder($oid);

        //模板赋值与渲染
        $this->assign("order",$order);
        return $this->fetch();
    }
}