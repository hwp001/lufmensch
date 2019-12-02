<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 9:51
 */

namespace app\wx\controller;
use app\common\model\Oils;
use app\common\model\Driver;
use app\common\model\Order;
use think\Controller;
use Request,Db;
//预约排队信息
class Line extends Controller
{
    //逻辑处理排队信息
    public function index()
    {

    }

    //搜索  后面补充一个车牌号 第二个字母大小写转换s
    public function search()
    {

        $data = Request::param();
        $dataType = '';
        //搜索内容为空则显示无数据
        if (empty($data['search']) && ($data['oilP'] == '请选择类型') && empty($data['oilC'])) {
            $dataType = 'noInfo';
        }
        if ($data['oilP'] == '请选择类型') {
            $data['oilP'] = '';
        } else if ($data['oilC'] == '请选择类型'){
            $data['oilC'] = '';
        }
        //获取全部预约列表
        $datas = [
            'oils' => $data['oilP'].$data['oilC'],
            'license' => $data['search']
        ];
        if (empty($data['oilC'])&& empty($data['oilP'])) {
            $sql = "select * from vehicle_order where license like '%".$datas['license']."%' and state =1";
        }elseif(empty($data['search'])){
            $sql = "select * from vehicle_order where oils like '%".$datas['oils']."%'and state = 1 ";
        }else {
            $sql = "select * from vehicle_order where oils like '%".$datas['oils']."%' or license like '%".$datas['license']."%' and state =1";
        }
        $orders = Db::query($sql);
        if (empty($orders)) {
            $orders = 'noInfo';
        } else {
            for($i = 0;$i < count($orders);$i++ ){
                switch ($orders[$i]['orderState']){
                    case 0 : $ssr = '已装完';$color = 'numCq';$font_color = ''; break;
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
        //获取油品类型
        $oils = (new Oils())->getPid();
        if (empty($oils)) {
            $this->error('油品类型暂无，请及时联系管理员');
        }
        $this->assign([
            'dataType' => $dataType,
            'orders'   => $orders,
            'oils'     => $oils
        ]);
        return $this->fetch();
    }
}