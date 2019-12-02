<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/6
 * Time: 20:48
 */

namespace app\common\controller;
use app\common\model\Order;
use think\Controller;
use PHPExcel_IOFactory;
use PHPExcel;
class Excel extends Controller
{
    // 导出 车辆excel
    public function outExcel($data){
        $objPHPExcel=new \PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
// 设置列的宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
// 设置表头
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', '车辆编号');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', '车牌号');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', '创建时间');
//$objPHPExcel->getActiveSheet()->getStyle('A2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
//存取数据
        $num = 2;
        foreach ($data as $k => $v) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $num, ' '.$v['id']); //防止订单号过长变成科学计算问题所以在订单号前拼接空字符，转化为字符串。 ' '.$v['order_no']

            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $num, $v['license']);

            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $num, $v['create_time']);
            $num++;
        }
// 文件名称
        $fileName = "车辆信息" . date('Y-m-d', time()) . rand(1, 1000);
        $xlsName = iconv('utf-8', 'gb2312', $fileName);
        $objPHPExcel->getActiveSheet()->setTitle('sheet'); // 设置工作表名
        $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel); //下载 excel5与excel2007
        ob_end_clean(); // 清除缓冲区,避免乱码
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl;charset=UTF-8");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header("Content-Disposition:attachment;filename=" . $xlsName . ".xls");
        header("Content-Transfer-Encoding:binary");
        $objWriter->save("php://output");
    }

  //导入
    public function InExcel()
    {
        //实例化类库
        $obj_phpexcel = new \PHPExcel();
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        //接收文件
        $inputdata = $_FILES;
        //获取并处理数据
        $objData = $objReader->load($inputdata['excel']['tmp_name'],$encode='urf-8');
        $execl_array = $objData->getSheet(0)->toArray();
        unset($execl_array[0]);
        for($i = 0; $i<count($execl_array);$i++) {
//            $data[$i]['id'] = $execl_array[$i+1][0];
            $data[$i]['oils'] = $execl_array[$i+1][1];
            $data[$i]['order_time'] = $execl_array[$i+1][2];
            $data[$i]['driverName'] = $execl_array[$i+1][3];
            $data[$i]['openid'] = $execl_array[$i+1][4]? $execl_array[$i+1][4]:0;
            $data[$i]['driverPhone'] = $execl_array[$i+1][5];
            $data[$i]['license'] = $execl_array[$i+1][6];
            $data[$i]['company'] = $execl_array[$i+1][7];
            $data[$i]['orderState'] = $execl_array[$i+1][8];
            $data[$i]['state'] = $execl_array[$i+1][9];
            $data[$i]['create_time'] = $execl_array[$i+1][10];
            $data[$i]['update_time'] = strtotime($execl_array[$i+1][11]);
            $data[$i]['delete_time'] = strtotime($execl_array[$i+1][12]);
        }
//        var_dump($data);die;
        //批量添加数据
        $row = (new Order())->saveAll($data);
        if ($row !== false){
           return true;
        } else {
            return false;
        }

    }
}