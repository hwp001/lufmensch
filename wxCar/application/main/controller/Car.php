<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/2
 * Time: 16:34
 */

namespace app\main\controller;
use app\main\controller\Base;
use app\common\validate\CarValidate;
use app\common\model\Car as Ca;
use app\common\controller\Excel;
use Request,Config,Db;
class Car extends Base
{
    //初始页面
    public function index()
    {
        $dataCar = '';
        if (Request::param()){
            $data = Request::param();
            if (empty($data)){
                $dataCar = 'noInfo';
            }
            $sql = "select * from vehicle_car where license like '%".$data['key']."%' and state = 1";
            $res = Db::query($sql);
            if (empty($res)) {
                $dataCar = 'noInfo';
            }
            $this->assign([
                'dataCar' => $dataCar,
                'cars'    => $res
            ]);
            return $this->fetch();
        }

        $cars = (new Ca())->getCars();
        $this->assign([
            'cars'    => $cars,
            'dataCar' => $dataCar
        ]);
        return $this->fetch();
    }

    //导出
    public function export()
    {
        if (Request::isPost()){
            $data = Request::param();
            if (empty($data)){
                $this->error('数据不弄为空');
            }
//            var_dump($data['data']);
            $cars = (new Ca())->getCarByIds($data['data']);
             (new Excel())->outExcel($cars);
        }
    }

    //添加页面
    public function add()
    {
        if (Request::isPost()){
            $data = Request::param();
            $data['license'] = $data['carOne'].$data['carTwo'].$data['carThree'];
            $carVali = new CarValidate();
            if ($carVali->check($data)) {
                $data = [
                    'license' => $data['license'],
                    'state'   => $data['state']
                ];
                $row = (new Ca())->add($data);
                if ($row !== false) {
                    $this->success('车辆新增成功','index');
                } else {
                    $this->error('车辆新增失败');
                }
            } else {
                $this->error('车牌号后五位有误');
            }
        }
        $carOnes = config::get('license.carOne');
        $carTwos = config::get('license.carTwo');
        $this->assign([
            'carOnes' => $carOnes,
            'carTwos' => $carTwos
        ]);
        return $this->fetch();
    }

    //饼图绘制
    public function pie()
    {
        $data = Request::param();
        if (empty($data)) {
            $this->error('车牌号不能为空');
        }
        $sql = "select * from vehicle_car where license like '%".$data['license']."%' and state = 1 ";
        $result = Db::query($sql);
        if (!$result) {
            $this->error('此车辆暂未被预约过');
        }
        $license = '';
        //统计订单中车辆油品 ，取其中一条数据，若数据存在，跳出循环
        foreach ($result as $v) {
            $sql = "select count(oils) as value,oils as name from vehicle_order where license = '".$v['license']."' group by oils;";
            $res = Db::query($sql);
            if ($res != false){
                $license = $v['license'];
                break;
            }
        }
        if (!$res) {
            $this->error('此车辆暂无具体数据');
        }
        for ($i = 0; $i<count($res); $i++) {
            $res[$i]['name'] = "'".$res[$i]['name']."'";
        }
        $res=json_encode($res,true);
        $res=str_replace('"', '', $res);
        $this->assign([
            'res'     => $res,
            'license' => $license
        ]);
        return $this->fetch();
    }

}