<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 9:52
 */

namespace app\wx\controller;
use app\common\model\Car;
use app\common\model\Driver;
use think\Controller;
use app\common\validate\DriverValidate;
use app\common\model\Order;
use Request,Session,Config;
//个人信息
class Mine extends Controller
{
    //我的信息
    public function index()
    {
        $driver = (new Driver())->getDriver(Session::get('openid'));
        if (empty($driver)){
            $this->error('账号异常，获取openid失败');
        }

        $this->assign([
            'driver' => $driver
        ]);
        return $this->fetch();
    }

    //预约记录
    public function order()
    {
        $orders = (new Order())->getOrdersByOpenId(Session::get('openid'));
        if (empty($orders)) {
            $orders = 'noInfo';
        } else {
            $orders = $orders->toArray();
            $font_color ='';
            for($i = 0;$i < count($orders);$i++ ){
                switch ($orders[$i]['orderState']){
                    case 0 : $ssr = '已装完';$color = 'numCq';$font_color = ''; break;
                    case 1 : $ssr = '正在装';$color = 'numIng';$font_color = 'one'; break;
                    case 2 : $ssr = '厂内待装';$color = 'numCq';$font_color = 'two'; break;
                    case 3 : $ssr = '厂外待装';$color = '';$font_color = 'three';break;
                    case 4 : $ssr = '暂停中';$color = 'numRed';$font_color = 'four';break;
                }
                $orders[$i]['ssr']        = $ssr;
                $orders[$i]['color']      = $color;
                $orders[$i]['font_color'] = $font_color;
            }
        }
        $this->assign([
            'orders' => $orders
        ]);
        return $this->fetch();
    }

    //修改个人信息
    public function updateInfo()
    {
        $openid = Session::get('openid');
        $data = Request::param();
        //截取第一个字母 第一个为中文字符 占三位
        $data['One'] = substr($data['license'],0,3);
        //截取第二个字母
        $data['Two'] = substr($data['license'],3,1);
        //截取后五位字母
        $data['Three']= substr($data['license'],4);
        //判断第一位 和 第二位 是否在自定义模板里面
        $licenseTpl = config('license.');
        if (!in_array($data['One'],$licenseTpl['carOne'])){
            $this->error('第一位地区填写有误');
        } else if (!in_array($data['Two'],$licenseTpl['carTwo'])) {
            $this->error('第二位字母填写有误');
        }
        //验证车牌号是否存在
        $rows = (new Car())->findCar($data['license']);
        if (empty($rows)){
            $this->error('车牌号不存在，请重新填写');die;
        }
        //判断其他司机是否注册了此车牌号
        $rows = (new Driver())->verifyLicenseByopenid($openid,$data['license']);
        if ($rows > 0) {
            $this->error('此车牌号已经被其他司机注册请重新填写');
        }

        $driverVali = new DriverValidate();
        if ($driverVali->check($data)) {
            $data = [
                'trueName'   => $data['trueName'],
                'phone'      => $data['phone'],
                'company'    => $data['company'],
                'license'    => $data['license']
            ];
//            var_dump($data);die;
            $driverObj = (new Driver())->updateInfoByOpenId($openid,$data);
            if ($driverObj !== false) {
                $this->success('个人信息更改成功','logic/mine');
            } else {
                $this->error('个人信息更改失败，请稍后再试');
            }
        } else {
            $this->error($driverVali->getError());
        }

    }


}