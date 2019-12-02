function _select($key,$table){
			if(isset($key) && $key != ''){
			$wherelink = "&key=".$key;

			switch ($table) {
					case 'view_order':
			$where = "where destination  like '%".$key."%' or carLicense like '%".$key."%' or goodName like '%".$key."%' or orderId like '%".$key."%'"	;					
						break;

					case 'view_role':
			$where = "where roleName like '%".$key."%' or roleState like '%".$key."%' or roleId like '%".$key."%'";						
						break;
					
					default:
						echo "没有这张表的信息，请重新查询";
						die;
						break;
				}	

			// 组合SQL语句
			// 统计模糊查询结果有多少条数据
			$countsql = "select * from {$table} {$where}";
			// echo $countsql;
		}else{
			// 如果没有 就赋空
			$where = "";
			// 执行统计数据
			$countsql = "select * from {$table};";
			// 赋空
			$wherelink = '';
		}
		//执行统计 SQL语句
		$countU = $this->mysqli->query($countsql);
		// var_dump($countU);
		// 总数据量		--
		if (empty($count = @mysqli_num_rows($countU))){
			if ($key != "") {
				echo "<script>alert('未找到与‘{$key}‘相关匹配项');history.back();</script>";die;
			}
		}
		// var_dump($count);
		// 每一页要显示的数量
		$num = 5;
		//获取当前页数
		$this->page = isset($page) ? $page : 1;
		//总页数= 总数据量/每页要显示的数据量
		$total = ceil($count/$num);

		//分页公式		当前页数-1 * 每页要显示的数量
		$offset = ($this->page-1)*$num;
		//组合限制条件
		//从第几条开始查多少条
		$limit = "limit ".$offset.",".$num;

		$sql = "select*from {$table} {$where}{$limit}";

		$this->result = $this->mysqli->query($sql);
		// echo "执行成功";
		
	}

}