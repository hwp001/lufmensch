<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/4
 * Time: 17:13
 */

namespace app\wx\controller;
use app\common\model\Oils;
use app\wx\controller\Oauth;
use app\common\model\Driver;
use app\common\model\Order;
use think\Controller;
use Session,Config;
use think\validate\ValidateRule;

//判断菜单按钮入口
class Logic extends Controller
{
    //测试
    public function index()
    {

    }

    //排队查询
    public function line()
    {
        //判断司机是否授权登录过
       $this->isPermit(__FUNCTION__ );
        //获取油品顶级类
        $oils = (new Oils())->getPid();
        if (empty($oils)) {
            $this->error('油品类型暂无，请及时联系管理员');
        }
        //获取全部预约列表
        $orders = (new Order())->getCarInfoOnState();
        if (empty($orders)) {
            $orders = 'noInfo';
        } else {
            $orders = $orders->toArray();
            $font_color = '';
            for($i = 0;$i < count($orders);$i++ ){
                switch ($orders[$i]['orderState']){
                    case 1 : $ssr = '正在装';$color = 'numIng';$font_color = 'ing'; break;
                    case 2 : $ssr = '厂内待装';$color = 'numCq';$font_color = 'cq'; break;
                    case 3 : $ssr = '厂外待装';$color = '';$font_color = '';break;
                    case 4 : $ssr = '暂停中';$color = 'numRed';$font_color = 'notice';break;
                }
                $orders[$i]['ssr']        = $ssr;
                $orders[$i]['color']      = $color;
                $orders[$i]['font_color'] = $font_color;
            }
        }
//        var_dump($orders);die;
       $this->assign([
           'oils'   => $oils,
           'orders' => $orders
       ]);
       return $this->fetch();

    }

    //提交预约
    public function order()
    {
        //判断司机是否授权登录过
        $this->isPermit(__FUNCTION__ );
        $driver = (new Driver())->getDriver(Session::get('openid'));
        if (empty($driver)) {
            $this->error('用户信息获取失败');
        }
        //判断司机是否已经填写真实姓名、手机号码、备案车牌号
        if (empty($driver['trueName']) || empty($driver['phone'])|| empty($driver['license'])){
            $this->error('请往后台填写真实姓名、手机号码、备案车牌号');
        }
        //获取油品顶级类
        $oils = (new Oils())->getPid();
        if (empty($oils)) {
            $this->error('油品类型暂无，请及时联系管理员');
        }
        //获取第一位 和 第二位
        $One = Config::get('license.carOne');
        $Two = Config::get('license.carTwo');
//        var_dump($One,$Two);
        $this->assign([
            'driver' => $driver,
            'oils'   => $oils,
            'One'    => $One,
            'Two'    => $Two
        ]);
        return $this->fetch();
    }

    //个人中心
    public function mine()
    {
        //判断司机是否授权登录过
        $this->isPermit(__FUNCTION__ );
        //根据openid 获取司机信息
        $driver = (new Driver())->getDriver(Session::get('openid'));
        if (empty($driver)) {
            $this->error('司机信息有误,获取openid失败');die;
        }
        //根据当前openid 获取司机当前预约订单
        $driverOrder = (new Order())->getInfoByOpenId(Session::get('openid'));
//        var_dump($driverOrder);die;
        if (empty($driverOrder)) {
            $driverOrder = "noInfo";
        } else {
            $driverOrder = $driverOrder->toArray();
            switch ($driverOrder['orderState']){
                case 0 : $ssr = '已装完';$color = 'numCq'; break;
                case 1 : $ssr = '正在装';$color = 'numIng';$font_color = 'ing'; break;
                case 2 : $ssr = '厂内待装';$color = 'numCq';$font_color = 'cq'; break;
                case 3 : $ssr = '厂外待装';$color = '';$font_color = '';break;
                case 4 : $ssr = '暂停中';$color = 'numRed';$font_color = 'notice';break;
            }
            $driverOrder['ssr'] = $ssr;
            $driverOrder['color']      = $color;
            $driverOrder['font_color'] = $font_color;
        }
//        var_dump($driverOrder);die;
       $this->assign([
           'driver'      => $driver,
           'driverOrder' => $driverOrder
       ]);
        return $this->fetch();
    }


    //判断司机是否授权登录过
    public function isPermit($str)
    {
        $url = 'Logic/'.strtolower($str);
        if (!Session::has('openid')) {
            //设置session 授权后可以正确跳转页面
            Session::set('jump',$url);
//            var_dump($url);
            $this->redirect('Oauth/wantCode');
            return false;
        }
//        var_dump(Session::delete('nickname'));die;    //清除登录Session缓存
        return true;
    }

}