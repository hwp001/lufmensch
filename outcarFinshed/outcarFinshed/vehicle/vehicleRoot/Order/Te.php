<?php
// namespace app\admin\controller;
// use think\Controller;
// use think\Cookie;

// class Te extends Controller
// {
    // public function index(){
    //     // $res = db('php0101')->select();
    //     // $this->assign('list',$res);
    //     return $this->fetch();

    // }

    // //表格导入
    // public function import(){
    //     if(request()->isPost()){
    //         $file = request()->file('file');
    //         // 移动到框架应用根目录/public/uploads/ 目录下
    //         $info = $file->move(ROOT_PATH . 'public' .DS.'uploads'. DS . 'excel');
    //         if($info){
    //             //获取文件所在目录名
    //             $path=ROOT_PATH . 'public' . DS.'uploads'.DS .'excel/'.$info->getSaveName();
    //             //加载PHPExcel类
    //             vendor("PHPExcel.PHPExcel");
    //             //实例化PHPExcel类（注意：实例化的时候前面需要加'\'）
    //             $objReader=new \PHPExcel_Reader_Excel5();
    //             $objPHPExcel = $objReader->load($path,$encode='utf-8');//获取excel文件
    //             $sheet = $objPHPExcel->getSheet(0); //激活当前的表
    //             $highestRow = $sheet->getHighestRow(); // 取得总行数
    //             $highestColumn = $sheet->getHighestColumn(); // 取得总列数
    //             $a=0;
    //             //将表格里面的数据循环到数组中
    //             for($i=2;$i<=$highestRow;$i++)
    //             {
    //                 //*为什么$i=2? (因为Excel表格第一行应该是姓名，年龄，班级，从第二行开始，才是我们要的数据。)
    //                 $data[$a]['name'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();//姓名
    //                 $data[$a]['age'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();//年龄
    //                 $data[$a]['sex'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();//性别
    //                 $data[$a]['classid'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();//班级
    //                  // 这里的数据根据自己表格里面有多少个字段自行决定
    //                 $a++;
    //             }
    //             //往数据库添加数据
    //             $res = Db('php0101')->insertAll($data);
    //             if($res){
    //                     $this->success('操作成功！');
    //             }else{
    //                     $this->error('操作失败！');
    //                }
    //         }else{
    //             // 上传失败获取错误信息
    //             $this->error($file->getError());
    //         }
    //     }
    // }
/***********全部**********/
     function export(){
        // include('../database.php');
        $list = model('order')->select();//查order表数据
        vendor("PHPExcel.PHPExcel");//引入文件
        $objPHPExcel = new \PHPExcel();//实例化

        $objPHPExcel->getProperties()->setCreator("ctos")
            ->setLastModifiedBy("ctos")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

        //设置行高度
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

        //set font size bold
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //设置水平居中
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //合并cell
        $objPHPExcel->getActiveSheet()->mergeCells('A1:J1');

        // set table header content
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '订单数据汇总  时间:'.date('Y-m-d H:i:s'))
            ->setCellValue('A2', '订单ID')
            ->setCellValue('B2', '姓名')
            ->setCellValue('C2', '电话')
            ->setCellValue('D2', '车牌号')
            ->setCellValue('E2', '公司名称')
            ->setCellValue('F2', '油品编号')
            ->setCellValue('G2', '订单号')
            ->setCellValue('H2', '预约时间')
            ->setCellValue('I2', '出车状态');



        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<count($list);$i++){
            $objPHPExcel->getActiveSheet(0)->setCellValue('A'.($i+3), $list[$i]['id']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B'.($i+3), $list[$i]['name']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C'.($i+3), $list[$i]['phone']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('D'.($i+3), $list[$i]['car']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('E'.($i+3), $list[$i]['company']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F'.($i+3), $list[$i]['proid']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('G'.($i+3), $list[$i]['orderid']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('H'.($i+3), $list[$i]['ordertime']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('I'.($i+3), $list[$i]['state']);
            //$objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':J'.($i+3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            //$objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':J'.($i+3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getRowDimension($i+3)->setRowHeight(16);
        }


        //  sheet命名
        $objPHPExcel->getActiveSheet()->setTitle('订单汇总表');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // excel头参数
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="商品表('.date('Ymd-His').').xls"');  //日期为文件名后缀
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式

        $objWriter->save('php://output');

    }
/*******单个*********/
    //  function danexport(){
    //     $admin = json_decode(Cookie::get('admin'));
    //     $res = model('root')->where('rid','eq',$admin->rid)
    //                         ->where('root','eq','order-export')
    //                         ->find();
    //     if (!$res) {
    //         $this -> error('对不起！你没有该权限...','admin/count/order');
    //         exit;
    //     }
    //     // if (Session('users.rid') != 1 && Session('users.rid') != 2){
    //     //     return $this->error('此用户不能进行该操作','admin/order/index');
    //     // }
    //     $id = input('param.id');
    //     $list = model('order')->where('id','eq',$id)->find();
        
    //     vendor("PHPExcel.PHPExcel");
    //     $objPHPExcel = new \PHPExcel();

    //     $objPHPExcel->getProperties()->setCreator("ctos")
    //         ->setLastModifiedBy("ctos")
    //         ->setTitle("Office 2007 XLSX Test Document")
    //         ->setSubject("Office 2007 XLSX Test Document")
    //         ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    //         ->setKeywords("office 2007 openxml php")
    //         ->setCategory("Test result file");

    //     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

    //     //设置行高度
    //     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

    //     $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

    //     //set font size bold
    //     $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
    //     $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true);

    //     $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
    //     $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

    //     //设置水平居中
    //     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    //     $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //     $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //     $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //     $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //     //合并cell
    //     $objPHPExcel->getActiveSheet()->mergeCells('A1:J1');

    //     // set table header content
    //     $objPHPExcel->setActiveSheetIndex(0)
    //         ->setCellValue('A1', '订单数据汇总  时间:'.date('Y-m-d H:i:s'))
    //         ->setCellValue('A2', '订单ID')
    //         ->setCellValue('B2', '用户ID')
    //         ->setCellValue('C2', '车牌号')
    //         ->setCellValue('D2', '商品')
    //         ->setCellValue('E2', '重量')
    //         ->setCellValue('F2', '实际重量')
    //         ->setCellValue('G2', '目的地')
    //         ->setCellValue('H2', '订单编号')
    //         ->setCellValue('I2', '合同单号')
    //         ->setCellValue('J2', '提货单号')
    //         ->setCellValue('K2', '出发时间')
    //         ->setCellValue('L2', '送达时间')
    //         ->setCellValue('M2', '创建时间');



    //     // Miscellaneous glyphs, UTF-8
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('A'.(3), $list['id']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('B'.(3), $list['uid']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('C'.(3), $list['carnum']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('D'.(3), $list['goods']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('E'.(3), $list['number']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('F'.(3), $list['renumber']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('G'.(3), $list['aim']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('H'.(3), $list['orderid']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('I'.(3), $list['contract']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('J'.(3), $list['pick']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('K'.(3), $list['begintime']);
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('L'.(3), date("Y-m-d H:i:s",$list['endtime']));
    //         $objPHPExcel->getActiveSheet(0)->setCellValue('M'.(3), $list['addtime']);
            
    //         //$objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':J'.($i+3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
    //         //$objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':J'.($i+3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
    //         $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(16);
        


    //     //  sheet命名
    //     $objPHPExcel->getActiveSheet()->setTitle('订单汇总表');


    //     // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    //     $objPHPExcel->setActiveSheetIndex(0);


    //     // excel头参数
    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="商品表('.date('Ymd-His').').xls"');  //日期为文件名后缀
    //     header('Cache-Control: max-age=0');

    //     $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式

    //     $objWriter->save('php://output');
    //     $Test = new \my\loges;
    //     $Test->loges($id=$admin->id,$operate="单选导出订单",$status=1);

    // }
    /**
     * 多选导出Excel
     */
     function duoexport($data){
        require('../Method/method.php');
        // $admin = json_decode(Cookie::get('admin'));
        // $res = model('root')->where('rid','eq',$admin->rid)
        //                     ->where('root','eq','order-export')
        //                     ->find();
        // if (!$res) {
        //     $this -> error('对不起！你没有该权限...','admin/count/order');
        //     exit;
        // }
        // if (Session('users.rid') != 1 && Session('users.rid') != 2){
        //     return $this->error('此用户不能进行该操作','admin/order/index');
        // }
        // $id = input('param.');
        // dump($id);
        $con = new mysqlCon();
        $con->_connect();
        if (empty($data)){
            return $this->error('请选择导出的数据');
        }
        foreach ($data as $value) {
            // dump($value);
        // $list = model('order')->where('id','in',$value)->select();
            $sql = "select * from vehicle_order where orderId =".$value;
            $res = $con->mysqli->query($sql);
            $list[] = $res->fetch_assoc();
        }
        // var_dump($row);
        // die;
        
        include('../PHPExcel/PHPExcel.php');
        // vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new PHPExcel();
        // var_dump($objPHPExcel);
        // die();

        $objPHPExcel->getProperties()->setCreator("ctos")
            ->setLastModifiedBy("ctos")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

        //设置行高度
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

        //set font size bold
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //设置水平居中
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //合并cell
        $objPHPExcel->getActiveSheet()->mergeCells('A1:J1');

        // set table header content
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '订单数据汇总  时间:'.date('Y-m-d H:i:s'))
            ->setCellValue('A2', '订单编号')
            ->setCellValue('B2', '商品编号')
            ->setCellValue('C2', '车辆编号')
            ->setCellValue('D2', '司机编号')
            ->setCellValue('E2', '订单号')
            ->setCellValue('F2', '提货单号')
            ->setCellValue('G2', '订单生成时间')
            ->setCellValue('H2', '出发时间')
            ->setCellValue('I2', '到达时间')
            ->setCellValue('J2', '目的地')
            ->setCellValue('K2', '提货量')
            ->setCellValue('L2', '实际货物量')
            ->setCellValue('M2', '订单状态')
            ->setCellValue('N2', '删除状态')
            ->setCellValue('O2', '上架状态');



        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<count($list);$i++){
            $objPHPExcel->getActiveSheet(0)->setCellValue('A'.($i+3), $list[$i]['orderId']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B'.($i+3), $list[$i]['goodId']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C'.($i+3), $list[$i]['carId']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('D'.($i+3), $list[$i]['driverId']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('E'.($i+3), $list[$i]['orderNum']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F'.($i+3), $list[$i]['orderTiNum']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('G'.($i+3), date("Y-m-d H:i:s",$list[$i]['createTime']));
            $objPHPExcel->getActiveSheet(0)->setCellValue('H'.($i+3), date("Y-m-d H:i:s",$list[$i]['beginTime']));
            $objPHPExcel->getActiveSheet(0)->setCellValue('I'.($i+3), date("Y-m-d H:i:s",$list[$i]['lastTime']));
            $objPHPExcel->getActiveSheet(0)->setCellValue('J'.($i+3), $list[$i]['destination']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('K'.($i+3), $list[$i]['goodCount']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('L'.($i+3), date("Y-m-d H:i:s",$list[$i]['endtime']));
            $objPHPExcel->getActiveSheet(0)->setCellValue('M'.($i+3), $list[$i]['orderState']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('N'.($i+3), $list[$i]['delState']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('O'.($i+3), $list[$i]['existState']);

            
            //$objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':J'.($i+3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            //$objPHPExcel->getActiveSheet()->getStyle('A'.($i+3).':J'.($i+3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getRowDimension($i+3)->setRowHeight(16);
            }


        //  sheet命名
        $objPHPExcel->getActiveSheet()->setTitle('订单汇总表');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // excel头参数
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="商品表('.date('Ymd-His').').xls"');  //日期为文件名后缀
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式

        $objWriter->save('php://output');
        $Test = new \my\loges;
        $Test->loges($id=$admin->id,$operate="多选导出订单",$status=1);

    }
// }