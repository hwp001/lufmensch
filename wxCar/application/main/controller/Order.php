<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/7
 * Time: 11:40
 */

namespace app\main\controller;
use app\common\controller\Excel;
use app\common\model\Order as Orde;
use app\common\model\Car;
use app\common\model\Code;
use app\main\controller\Base;
use PHPExcel_IOFactory;
use PHPExcel;
use Request,Db,Log;
class Order extends Base
{
    //车辆预约信息显示
    public function index()
    {
        $dataOrder = '';
        //模糊搜索
       if (Request::isPost()){
           $data = Request::param();
           if (empty($data)) {
               $dataOrder = 'noInfo';
           }
           $sql = "select * from vehicle_order where license like '%".$data['key']."%' or driverPhone like '%".$data['key']."%' or company like '%".$data['key']."%'";
            $res = Db::query($sql);
            if (empty($res)) {
                    $dataOrder = 'noInfo';
            }
           for($i = 0;$i < count($res);$i++ ){
               switch ($res[$i]['orderState']) {
                   case 0 :
                       $ssr = '已装完';
                       break;
                   case 1 :
                       $ssr = '正在装';
                       break;
                   case 2 :
                       $ssr = '厂内待装';
                       break;
                   case 3 :
                       $ssr = '厂外待装';
                       break;
                   case 4 :
                       $ssr = '暂停中';
                       break;
               }
               $res[$i]['ssr'] = $ssr;
           }
            $this->assign([
                'dataOrder' => $dataOrder,
                'orders'     => $res
            ]);
           return $this->fetch();
       }


        //初始显示页面
        $res = (new Orde())->getOrders()->toArray();
        if (!$res) {
            $this->error('车辆预约信息获取失败');
        }
        for($i = 0;$i < count($res);$i++ ){
            switch ($res[$i]['orderState']) {
                case 0 :
                    $ssr = '已装完';
                    break;
                case 1 :
                    $ssr = '正在装';
                    break;
                case 2 :
                    $ssr = '厂内待装';
                    break;
                case 3 :
                    $ssr = '厂外待装';
                    break;
                case 4 :
                    $ssr = '暂停中';
                    break;
            }
            $res[$i]['ssr'] = $ssr;
        }
            $this->assign([
            'orders' => $res,
                'dataOrder' => $dataOrder
        ]);
        return $this->fetch();
    }

    //导入
    public function InOrder()
    {
       $bool = (new Excel())->InExcel();
       if ($bool){
           $this->success('导入信息成功','index');
       } else {
           $this->error('导入信息失败');
       }
    }



    //车辆排队显示
    public function line()
    {
        $dataOrder = '';
        //模糊搜索
        if (Request::isPost()){
            $data = Request::param();
            if (empty($data['start_time']) && empty($data['end_time'])){
                //如果时间都为空，直接搜索语句
                $sql = "select * from vehicle_order where orderState  = ".$data['orderState']." and orderState in (1,2,3,4) and state = 1 ";
            } else if($data['end_time'] <= $data['start_time']) {
                $this->error('结束时间不能小于等于开始时间');
            }else {
                $start_time = strtotime($data['start_time']);
                $end_time   = strtotime($data['end_time']);
                $sql = "select * from vehicle_order where orderState = ".$data['orderState']." and order_time > ".$start_time."  and order_time < ".$end_time."  and orderState in (1,2,3,4) and state = 1 ";
            }
            $res = Db::query($sql);
            if (empty($res)){
                //搜索不到车辆信息
                $this->success('暂无车辆信息','line');
            } else {
                for($i = 0;$i < count($res);$i++ ){
                    switch ($res[$i]['orderState']) {
                        case 1 :
                            $ssr = '正在装车';$color = "one";
                            break;
                        case 2 :
                            $ssr = '厂内待装';$color = "two";
                            break;
                        case 3 :
                            $ssr = '厂外待装';$color = "three";
                            break;
                        case 4 :
                            $ssr = '暂停装车';$color = "four";
                            break;
                    }
                    $res[$i]['ssr']   = $ssr;
                    $res[$i]['color'] = "background-color: ".$color;
                }
            }
            $this->assign([
                'dataOrder' => $dataOrder,
                'lines'     => $res
            ]);
            return $this->fetch();
        }


        //初始页面
        $res = (new Orde())->getCarInfoOnStates();
        //判断数据集是否为空
        if ($res->isEmpty()) {
            $dataOrder = 'noInfo';
        } else {
            $res = $res->toArray();
            for($i = 0;$i < count($res['data']);$i++ ){
                switch ($res['data'][$i]['orderState']) {
                    case 1 :
                        $ssr = '正在装车';$color = "one";
                        break;
                    case 2 :
                        $ssr = '厂内待装';$color = "two";
                        break;
                    case 3 :
                        $ssr = '厂外待装';$color = "three";
                        break;
                    case 4 :
                        $ssr = '暂停装车';$color = "four";
                        break;
                }
                $res['data'][$i]['ssr']   = $ssr;
                $res['data'][$i]['color'] = "background-color: ".$color;
            }
        }

        $this->assign([
            'dataOrder' => $dataOrder,
            'lines'     => $res['data']
        ]);
        return $this->fetch();
    }

    //ajax 暂停装车
    public function pause()
    {
        $license = Request::param('license');
        log::write($license);
        //记录当前车牌号所在行数
        $row = '';
        //查找所有车辆
        $res = (new Orde())->getCarInfoOnStates();
        //判断数据集是否为空
        if ($res->isEmpty()) {
            $dataOrder = 'noInfo';
        } else {
            $res = $res->toArray();
            //更改
            $res = $res['data'];
            foreach ($res as $k => $v){
                if ($v['license'] == $license){
                    $row = $k;
                }
            }
            //截取数组
            $res = array_slice($res,$row);
            //改变此车牌后面所有的状态
            for($i = 0;$i < count($res);$i++ ){
                    $res[$i]['orderState'] = 4;
                    $res[$i]['create_time'] = strtotime($res[$i]['create_time']);
                    $res[$i]['update_time'] = strtotime($res[$i]['update_time']);
                    $res[$i]['delete_time'] = strtotime($res[$i]['delete_time']);
                }
                Log::write($res);
//                $row = Db::name('order')->update($res);
            $row = (new Orde())->saveAll($res);
            Log::write($row);
            if ($row !== false){
                return json(['msg'=>'暂停成功']);
            } else {
                return json(['mag'=>'暂停失败']);
            }
            }
        }

    //ajax 后撤
    public function back(){
        $license = Request::param('license');
        log::write($license);
        //记录当前车牌号所在行数
        $row = '';
        //查找所有车辆
        $res = (new Orde())->getCarInfoOnStates();
        //判断数据集是否为空
        if ($res->isEmpty()) {
            $dataOrder = 'noInfo';
        } else {
            $res = $res->toArray();
            //获取当前车牌行数
            $res = $res['data'];
            foreach ($res as $k => $v){
                if ($v['license'] == $license){
                    $row = $k;
                }
            }
            //改变前后车牌状态 判断是否为最后一位 最后一位不可后撤
            if (($row+1) == count($res)) {
                return json(['msg'=>'已经是最后一位，不可后撤']);
            }
            //将当前位和后撤一位 存入临时表
            $data[] = $res[$row];
            $data[] = $res[$row+1];
            Log::write($data);
            //当前位置和后一位交换 预约时间 和 预约状态
            $tmp = $data[0];
            $data[0]['orderState'] = $data[1]['orderState'];
            $data[0]['order_time'] = $data[1]['order_time'];
            $data[1]['orderState'] = $tmp['orderState'];
            $data[1]['order_time'] = $tmp['order_time'];
            //创建时间 更新时间 已经被框架默认转换为字符串形式
            for($i = 0;$i < count($data);$i++){
                $data[$i]['create_time'] = strtotime($data[$i]['create_time']);
                $data[$i]['update_time'] = strtotime($data[$i]['update_time']);
                $data[$i]['delete_time'] = strtotime($data[$i]['delete_time']);
            }
            log::write($data);
            //批量更新
            $row = (new Orde())->saveAll($data);
            Log::write($row);
            if ($row !== false){
                return json(['msg'=>'后撤成功']);
            } else {
                return json(['mag'=>'后撤失败']);
            }
        }
    }

    //ajax 删除
    public function del()
    {
        $license = Request::param('license');
        $id = (new Orde())->getIdBylicense($license);
        if ($id->isEmpty()){
            $this->error('暂无车辆信息');
        }else {
            $id = $id->id;
        }
        $row = (new Orde())->destroy($id);
        Log::write($row);
        if ($row !== false) {
            return json(['msg' => '删除成功']);
        } else {
            return json(['msg' => '删除失败']);
        }
    }

    //编辑
    public function edit()
    {
        if (Request::isPost()) {
            $datas = Request::param();
            //更新订单中的车辆信息
            $license     = $datas['license'];
            $orderState  = $datas['orderState'];
            //正在装车 厂区待装 厂外待装 同一时刻只有一个 （需要判断校验 后期补）
            $carObj = (new Orde())->verifyOrderState($license,$orderState);
            //没有相同数据
            if ($carObj === null) {
                //覆盖更新 多一个update
                $row = (new Orde())->updateOrderState($license,$orderState);
                if (!$row){
                    $this->error('车辆信息不存在');
                } else {
                    $this->success('车辆状态更新成功','line');
                }
            } else {
                $this->error('当前车辆状态已经存在');
            }

        }

        $data = Request::param('license');
        //传过来的是 拼接字符串 车牌号|车辆状态
        $dataArr = explode('|',$data);
        list($license,$orderState) = $dataArr;
        //选定checked
        $ssr['one'] = $ssr['two'] = $ssr['three'] = $ssr['zero'] = $ssr['four'] = '';
        switch ($orderState) {
            case 0 : $ssr['zero'] = 'checked';break;
            case 1 : $ssr['one'] = 'checked';break;
            case 2 : $ssr['two'] = 'checked';break;
            case 3 : $ssr['three'] = 'checked';break;
            case 4 : $ssr['four'] = 'checked';break;
        }
        $this->assign([
            'license' => $license,
            'ssr'     => $ssr
        ]);
        return $this->fetch();
    }
}