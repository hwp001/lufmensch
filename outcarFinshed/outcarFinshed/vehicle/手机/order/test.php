<?php
require('../Method/method.php');
class dimF extends mysqlCon{
	public $page;

		//$key 搜索内容
		//$table 搜索表
		// 判断模糊搜索得语句,管理员，角色，司机，车辆，商品
		function _select($key,$table,$driverId=""){
			
			if ($key != "") {
				if ($key == 'nobody') {
					$yes = 1; //输出全部内容
				}else{
					$yes = 2;//进行模糊搜索
				}
			}else{
				$yes = 0; //没有更多内容
			}
			if ($yes == 0) {
				$where = "where existState = 2"; //数据库中不存在existState 等于2来判定
			}elseif($yes == 1) {	
				$where = "where delState = 1 and existState = 1";
			}elseif($yes == 2) {
				$where = "where (goodName like '%".$key."%' or carLicense like '%".$key."%') and delState = 1 and existState = 1 ";
			}
			$where .=$driverId;
			$order = " order by orderState, createTime desc";
			$limit = "limit 5";
			$sql = "select * from {$table} {$where} {$order} {$limit}";
			$res = $this->mysqli->query($sql) or die("数据库语句执行失败".$this->mysqli->error);
			return $res;

	}

}