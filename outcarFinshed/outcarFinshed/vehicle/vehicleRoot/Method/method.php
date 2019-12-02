 <?php
 //数据库常量定义
define('HOST', 'localhost');
define('ROOT', 'root');
define('PWD','hwp');
define('DB', 'vehicle01');
define('NUM', '5');
@session_start();
setcookie('root', '1', time()+60*60, '/');
	
// echo "<pre>";
// print_r($_SESSION);

//数据库连接
class mysqlCon{
	public $mysqli;
	function __construct(){}
	function _connect(){
		$this->mysqli = @new mysqli(HOST, ROOT, PWD, DB) or die('数据库连接不成功'.$mysqli->error);
	   $this->mysqli->query("set names 'utf8'");	  
	 	  // echo "数据库连接成功"; 
	}
	//查询语句
	// function _select($key,$table){}
	//添加语句
	function _test(){
		$res = $this->mysqli->query('select * from vehicle_user where delState = 1');
		while (($row = $res->fetch_assoc()) && mysqli_affected_rows($this->mysqli)>0) {
			 print_r($row);
		}
	}
	//删除语句 
	function delete(){}
	//简单查询 
	function select($table,$where = "where delState = 1"){		
		$sql = "select * from {$table} {$where}";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		return $res;
	}

}

// $test = new mysqlCon();
// $test->_connect();
// $test->_test();



//登录校验
class  mysqlLoginCheck extends mysqlCon{

  	function _checkLogin($usernameK,$pwdK){

  		//去除空格
  		$username = trim($usernameK);
  		$pwd = trim($pwdK);
  		 $res = ($this->mysqli)->query("select * from vehicle_user as a,vehicle_role as b where a.roleId = b.roleId and a.delState = 1;");
	  	  if (!$res) {
	          die('数据库语句执行失败'.$this->mysqli->error);}
  		while (($row = $res->fetch_assoc()) && mysqli_affected_rows($this->mysqli) >0) {
  				// echo $username,$pwd;
  				// die;
  		if (!empty($username)) {
  			 if ($row['userName'] == $username) {
  			 	if (!empty($pwd)) {
				 	if ($row['userPwd'] == md5($pwd)) {
	 					$login = 'login';
	 					$roleName = $row['roleName'];
	 					$this->_updateTime($row['userId']);
	 					$this->_updateIp($row['userId']);
	 					// var_dump($row['loginTimes']);
	 					$this->_updateTimes($row['userId'],$row['loginTimes']);
	 					$_SESSION['userName'] = $row['userName'];
	 					$_SESSION['roleId'] = $row['roleId'];
	 					$_SESSION['userId'] = $row['userId'];
	 					$_SESSION['roleName'] = $row['roleName'];
				 		break;
				 	} else {
				 		$login = 'nopwd';
				 		break;
				 	}  			 		
  			 	} else {
  			 		$login = 'pwdEmpty';
  			 		break;
  			 	}

			 } else {
			 		$login = 'nobody';
			 }

   } else {
   		$login = 'userEmpty';
   		break;
   }
  				
}

		switch ($login) {
			case 'login':
				echo "<script>alert('{$username}  {$roleName}登陆成功');location.href='../vehicleIndex.php?a=1'</script>"; 
				break;
			case 'nopwd':
				echo "<script>alert(' {$username} 密码错误');history.back()</script>";
				break;
			case 'nobody':
				echo "<script>alert(' {$username} 用户不存在');history.back()</script>";
				break;
   			case 'userEmpty':
   				$_SESSION['time']++;
   				echo "<script>alert('用户名不能为空');history.back()</script>";
   				break;
   			case 'pwdEmpty':
   				$_SESSION['time']++;
   				echo "<script>alert('密码不能为空');history.back()</script>";					
			default:
				die("\$login 没有值");
		}
  	}

		//更新日期
  		function _updateTime($id){
  			$loginTime = strtotime('now');
  			$updateSql = "update vehicle_user set loginTime = {$loginTime} where userId = {$id};";
  			($this->mysqli)->query($updateSql) or die("数据库语句执行失败".$this->mysqli->error);
  		}

  		//更新登陆IP
  		function _updateIp($id){
  			$loginIp = $this->_getIp();
  			//var_dump($loginIp);
  			// die;
   			$updateSql = "update vehicle_user set loginIp = '{$loginIp}' where userId = {$id};";
  			($this->mysqli)->query($updateSql) or die("数据库语句执行失败".$this->mysqli->error);
 			
  		}

  		//更新登录次数
  		function _updateTimes($id,$loginTimes){
  			$loginTimes += 1;
  			// print_r($loginTimes);die;
  			$updateSql = "update vehicle_user set loginTimes = '{$loginTimes}' where userId = '{$id}';";
  			($this->mysqli)->query($updateSql) or die("数据库语句执行失败".$this->mysqli->error);	
  		}

  		//获取本地IP
	 	function _getIp(){
			$host_name = exec("hostname");
			$host_ip = gethostbyname($host_name); //获取本机的局域网IP	 
			if( empty( $host_ip ) ){	    
				return "0.0.0.0";    
			 }else{
			    return $host_ip;
			 }
		} 	
	

}







//模糊查询
class dimFound extends mysqlCon{
	public $result;
	public $page;
	public $total;
	public $wherelink;
	public $count;
		//$key 搜索内容
		//$table 搜索表
		// 判断模糊搜索得语句,管理员，角色，司机，车辆，商品
		// $id = 根据什么字段进行排序
		// $back 当前目录文件名
		function _select($key,$table,$back,$id=''){
			if(isset($key) && $key != ''){
			$this->wherelink = "&key=".$key;

			switch ($table) {
					case 'view_user':
			$where = "where (userName like '%".$key."%') and delState = 1";					
						break;

					case 'view_role':
			$where = "where (roleName like '%".$key."%' or roleState like '%".$key."%' or roleId like '%".$key."%') and delState = 1";						
						break;

					case 'vehicle_logss':
			$where = "where (userName like '%".$key."%' or roleName like '%".$key."%') and delState = 1";				
						break;

					case 'vehicle_log':
			$where = "where (userName like '%".$key."%') and delState = 1";						
						break;

					case 'vehicle_car':
			$where = "where (carId like '%".$key."%' or carLicense like '%".$key."%') and delState = 1";						
						break;

					case 'vehicle_drivers':
			$where = "where (driverName like '%".$key."%' or driverId like '%".$key."%') and delState = 1";						
						break;

					case 'vehicle_goods':
			$where = "where (goodId like '%".$key."%' or goodName like '%".$key."%') and delState = 1";							
						break;

					case 'view_order':
			$where = "where (orderNum like '%".$key."%' or carLicense like '%".$key."%' or orderTiNum like '%".$key."%' or contract like '%".$key."%') and delState = 1";							
						break;

					case 'vehicle_role':
			$where = "where (roleName like '%".$key."%') and delState = 1";							
						break;
					case 'view_orderS':
			$where = "where (carLicense like '%".$key."%') and delState = 1";	
						break;

					case 'vehicle_log':
			$where = "where (driverId like '%".$key."%') and delState = 1";	
						break;
					case 'view_c3':
			$where = "where (driverId like '%".$key."%') and delState = 1";	
						break;
					case 'view_count':
					
					if ($key == '进行中') {
						$key  = 1;
					} elseif ($key == '已完成') { 
						$key = 2;
					}
			$where = "where (orderState like '%".$key."%') and delState = 1";	
						break;

					default:
						echo "没有这张表的信息，请重新查询";
						die;
						break;
				}	

			// 组合SQL语句
			// 统计模糊查询结果有多少条数据
			$countsql = "select * from {$table} {$where}";
			 // var_dump($countsql);die;
			// echo $countsql;
		}else{
			// 如果没有 就赋空
			$where = "where delState = 1";
			// 执行统计数据
			$countsql = "select * from {$table} {$where};";
			// 赋空
			$this->wherelink = '';
		}
		//执行统计 SQL语句
		$countU = $this->mysqli->query($countsql);
		// var_dump($countU);
		// 总数据量		--
		// var_dump($countU);die;
		if (empty($this->count = @mysqli_num_rows($countU))){
			if ($key != "") {
				echo "<script>alert('未找到与‘{$key}‘相关匹配项');location.href='../{$back}/index.php';</script>";die;
			}
		}
		// var_dump($count);
		// 每一页要显示的数量
		$num = 10;
		//获取当前页数
		$this->page = isset($_GET['page']) ? $_GET['page'] : 1;
		//总页数= 总数据量/每页要显示的数据量
		$this->total = ceil($this->count/$num);
		//分页公式		当前页数-1 * 每页要显示的数量
		$offset = ($this->page-1)*$num;
		//组合限制条件
		//从第几条开始查多少条
		$limit = "limit ".$offset.",".$num;

		$where .=" order by {$id} desc";

		$sql = "select*from {$table} {$where} {$limit}";	

		$this->result = $this->mysqli->query($sql) or die('数据库语句执行失败'.$this->mysqli->error);

		
	}

}




//增加 , 修改，删除 表单内容
class addInfo extends mysqlCon{

	//判断角色编号是否存在数据库里面
	function _judRole($role,$tab){
		$sql = "select * from {$tab}";
		$res = $this->mysqli->query($sql);
			$yes = false;				
		while (($row = $res->fetch_assoc()) && mysqli_affected_rows($this->mysqli)>0){
			if ($row['roleId'] == $role && $row['roleId'] != '1') {
				$yes = true;
			}
		}
		return $yes;
	
	}
	//判断此用户名是否已经创建了并且未被删除delState = 1
	function _judName($userName,$table,$where=""){
		$sql = "select * from {$table} {$where}";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		$Name = false;
		$Uname = '';				
		while (($row = $res->fetch_assoc()) && mysqli_affected_rows($this->mysqli)>0){
			switch ($table) {
				case 'vehicle_user':
					$Uname = 'userName';
					break;
				case 'vehicle_car':
					$Uname = 'carLicense';
					break;
				case 'vehicle_drivers':
					$Uname = 'driverName';
					break;				
				case 'vehicle_order':
					$Uname = 'orderId';
					break;				
				case 'vehicle_goods':
					$Uname = 'goodName';
					break;				
				case 'vehicle_role':
					$Uname = 'roleName';			
			}
			if (($row[$Uname] == $userName) && ($row['delState'] == 1 )) {
				$Name = true;
			}
		}
		return $Name;		
	}

	//判断司机手机号是否已经存在
	function _judPhone($phone){
		$sql = "select * from vehicle_drivers where driverPhone = '{$phone}' and delState = 1";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		//如果影响行数大于等于2，说明改这个账号会和别人撞衫
		if (mysqli_affected_rows($this->mysqli)>1) {
				return 2;
			} elseif (mysqli_affected_rows($this->mysqli)>0) {
			return false; //存在
		} else {
			return true; // 不存在
		}
	}

	//插入数据到表里面去
	function _insert($colum,$table){
		$value = array_values($colum);
		$key = array_keys($colum);
		//判断值是否为字符串，是的话加一个单引号
		foreach ($value as $k=>$v) {
			if (is_string($v)) {
				$v = "'{$v}'";
			}
			$Value[] = $v;
		}
		 $values = implode($Value, ',');
		// var_dump($values);die;

		$keys = implode($key, ',');
		// echo $values."<br>".$keys."<br>";
		$sql = "insert into {$table} ({$keys}) values ({$values})";
		// echo $sql;die;
		$this->mysqli->query($sql) or die("插入语句失败.{$this->mysqli->error}");

		//增加信息成功返回一个true
		if (mysqli_affected_rows($this->mysqli)) {			
			return true;
		} else {
			return false;
		}
		// echo "<script>alert('信息信息增加成功');location.href='./index.php'</script>";
		}

	//假删除
	function _del($id,$table){
		$yes = false;
		switch ($table) {
			case 'vehicle_user':
				$ID = 'userId';
				break;			
			case 'vehicle_goods':
				$ID = 'goodId';
				break;			
			case 'vehicle_car':
				$ID = 'carId';
				break;			
			case 'vehicle_drivers':
				$ID = 'driverId';
				break;			
			case 'vehicle_order':
				$ID = 'orderId';
				break;			
			case 'vehicle_role':
				$ID = 'roleId';
				break;			
			case 'vehicle_log':
				$ID = 'logid';
				break;			
			default:
				die("请根据你的内容穿一个正常的参数");
				break;
		}
		$sql = "update {$table} set delState = 0 where {$ID} = {$id} ;";
		$this->mysqli->query($sql) or die("删除语句失败 {$this->mysqli->error}");
		$yes = true;
		return $yes;
	}
	//批量删除
	function _allDel($where){
		$sql = "update vehicle_car set delState = 0 {$where}";
		$this->mysqli->query($sql) or die('数据库语句执行失败'.$this->mysqli->error);
		if (mysqli_affected_rows($this->mysqli)>0) {
			return true;
		} else {
			return false;
		}

	}


	//表单信息更改之信息显示
	function _found($id,$info){
		switch ($info) {
			case 'node':
		$sql = "select userId,userName,userPwd,a.roleId,trueName,loginState,roleName from vehicle_user as a,vehicle_role as b where a.roleId = b.roleId and a.userId = {$id}";
				break;
			case 'car':
		$sql = "select * from vehicle_car where carId = {$id};";
				break;
			case 'order':
		$sql = "select * from view_order where orderId = {$id};";
					break;	
			case 'good':
		$sql = "select * from vehicle_goods where goodId = {$id};";
					break;	
			case 'driver':			
		$sql = "select * from vehicle_drivers where driverId = {$id};";
					break;	
			case 'Driver':			
		$sql = "select * from vehicle_drivers where driverId = {$id};";
					break;	
			case 'order01':			
		$sql = "select * from vehicle_goods as b,vehicle_car as c,vehicle_order as d where b.goodId = d.goodId and d.carId and c.carId and orderId = {$id};";
					break;	
			default:
				# code...
				break;
		}
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		// echo "数据库语句执行成功";
		return $res;
	}

	//表单信息更改
	function _update($colum,$table){
		$yes = true;
		switch ($table) {
			case 'vehicle_user':				
		$sql = "update {$table} set userName = '{$colum['userName']}',userPwd = '{$colum['userPwd']}',roleId = {$colum['roleId']},trueName = '{$colum['trueName']}',loginState = '{$colum['loginState']}' where userId = {$colum['userId']};";
			break;
			case 'vehicle_drivers':
		$sql = "update {$table} set driverPhone = '{$colum['driverPhone']}',driverPwd = '{$colum['driverPwd']}',driverName = '{$colum['driverName']}' where driverId = {$colum['driverId']};";				
			break;

			case 'vehicle_car':
		$sql = "update {$table} set carLicense = '{$colum['carLicense']}',carState = '{$colum['carState']}' where carId = {$colum['carId']}";		
				break;		
			
			case 'vehicle_goods':
		$sql = "update {$table} set goodName = '{$colum['goodName']}', goodTrueNum = {$colum['goodTrueNum']},goodNum = {$colum['goodNum']},goodSales = {$colum['goodSales']} where goodId = {$colum['goodId']}";	
				break;
			case 'vehicle_order':
		$sql = "update {$table} set orderNum = {$colum['orderNum']}, carId = {$colum['carId']}, beginTime = {$colum['beginTime']}, destination = '{$colum['destination']}', goodId = {$colum['goodId']}, goodCount = {$colum['goodCount']} where orderId = {$colum['orderId']}";			
				break;
			case 'vehicle_role':
		$sql = "update {$table} set roleState = {$colum['roleState']},rootName = '{$colum['rootName']}',updateTime = {$colum['updateTime']} where roleId = {$colum['roleId']}";
				break;			
			default:
				# code...
				break;
		}
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		// echo "数据库语句执行成功";
		if (mysqli_affected_rows($this->mysqli)>0) {
			return true;			
		} else {
			return false;
		}
	}
	//订单表编辑详情
	function _updateOrder($colum,$table){
		$sql = "update {$table} set orderNum = {$colum['orderNum']}, carId = {$colum['carId']}, beginTime = {$colum['beginTime']}, destination = '{$colum['destination']}', goodId = {$colum['goodId']}, goodCount = {$colum['goodCount']}, existState = {$colum['existState']} where orderId = {$colum['orderId']}";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		// echo "数据库语句执行成功";
		if (mysqli_affected_rows($this->mysqli)>0) {
			return true;	
		} else {
			return false;
		}

	}
	//小更改订单状态信息
	function _orderState($colum){
		$sql = "update vehicle_order set orderState = {$colum['orderState']} where orderId = {$colum['orderId']}";
		$this->mysqli->query($sql) or die('数据库语句执行失败'.$this->mysqli->error);
		return true;
	}


	//小更改司机状态信息
	function _DriverState($colum){
		$sql = "update vehicle_drivers set driverBlock = {$colum['driverBlock']},driverState = {$colum['driverState']} where driverId = {$colum['driverId']}";
		$this->mysqli->query($sql) or die('数据库语句执行失败'.$this->mysqli->error);
		return true;
	}

	//判断商品数量是否为 0 
 		function _goodNum($id){
 			$sql = "update vehicle_goods set goodState = 0 where goodTrueNum = 0 and goodId = {$id}";
 			$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		 echo "数据库语句执行成功";
		//return true;
 		}

}


class upLogs extends mysqlCon{
	function uplog($values){
		$userId = $_SESSION['userId'];
		$values .= $values;
		$sql = "update vehicle_logs set userActivity = {$values} from vehicle_logs as a,vehicle_user as b where a.userId = b.userId and userId = {$userId}";
		$res = $this->mysqli->query($sql);
		return $res;
	}
}





		/**
		 * 更新日志
		 */
		class upLOG extends addInfo
		{
				function _up($activity='登录',$ActivityState = 1){
					if (!isset($_SESSION['userName']) || !isset($_SESSION['roleName'])) {
						echo "请先登录，谢谢";die;
					}
					$colum['userName'] = @$_SESSION['userName'];
					$colum['roleName'] = @$_SESSION['roleName'];
					$colum['ActivityState'] = $ActivityState;
					$colum['logIp'] = $this->_getIp();
					$colum['activityTime'] = time();
					$colum['activity'] = $activity;
					// var_dump($colum);die;
					$this->_connect();
					$yes = $this->_insert($colum,'vehicle_log');
					if (!$yes) {
						//echo "<script>alert('日志更新失败');</script>";
					} 
					//echo "<script>alert('日志更新成功');</script>";
				}

						//获取本地IP
				 	function _getIp(){
						$host_name = exec("hostname");
						$host_ip = gethostbyname($host_name); //获取本机的局域网IP	 
						if( empty( $host_ip ) ){	    
							return "0.0.0.0";    
						 }else{
						    return $host_ip;
						 }
					} 

		}

//获取本地IP方法外
				 	function _getIp(){
						$host_name = exec("hostname");
						$host_ip = gethostbyname($host_name); //获取本机的局域网IP	 
						if( empty( $host_ip ) ){	    
							return "0.0.0.0";    
						 }else{
						    return $host_ip;
						 }
					} 