 <?php
 //数据库常量定义
define('HOST', 'localhost');
define('ROOT', 'root');
define('PWD','hwp');
define('DB', 'vehicle01');
//数据库连接
class mysqlCon{
	public $mysqli;
	function __construct(){}
	function _connect(){
		$this->mysqli = @new mysqli(HOST, ROOT, PWD, DB) or die('数据库连接不成功'.$mysqli->error);
	   $this->mysqli->query("set names 'utf8'");	  
	 	 //  echo "数据库连接成功"; 
	}
	//简单查询
	function select($table,$where = "where delState = 1"){		
		$sql = "select * from {$table} {$where}";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		return $res;
	}	
}
class  mysqlLoginCheck extends mysqlCon{

  	function _checkLogin($usernameK,$pwdK){

  		//去除空格
  		$username = trim($usernameK);
  		$pwd = trim($pwdK);
  		 $res = ($this->mysqli)->query("select * from vehicle_drivers where driverBlock = 1 and driverState = 1 and delState = 1");
	  	  if (!$res) {
	          die('数据库语句执行失败');}
  		while (($row = $res->fetch_assoc()) && mysqli_affected_rows($this->mysqli) >0) {
  				// echo $username,$pwd;
  				// die;
  		if (!empty($username)) {
  			 if ($row['driverPhone'] == $username) {
  			 	if (!empty($pwd)) {
				 	if ($row['driverPwd'] == md5($pwd)) {
	 					$login = 'login';
	 					 $roleName = $row['driverName'];
	 					 $_SESSION['driverId'] = $row['driverId'];
	 					 $_SESSION['driverImg'] = $row['driverImg'];
	 					 $_SESSION['driverName'] = $row['driverName'];
	 					 $_SESSION['driverPhone'] = $row['driverPhone'];	 					 
	 					 // var_dump($_SESSION['driverName']);die;
	 					// $this->_updateTime($row['userId']);
	 					// $this->_updateIp($row['userId']);
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
				echo "<script>alert('{$username}  {$roleName}登陆成功');window.location.href='../myself/myself.php?a=1'</script>";
				$_SESSION['driverPhone'] = $username; 

				break;
			case 'nopwd':
				echo "<script>alert(' {$username} 密码错误');window.location.href='../login/index.php';</script>";
				break;
			case 'nobody':
				echo "<script>alert(' {$username} 账号不存在');window.location.href='../login/index.php';</script>";
				break;
   			case 'userEmpty':
   				echo "<script>alert('账号不能为空');window.location.href='../login/index.php';</script>";
   				break;
   			case 'pwdEmpty':
   				echo "<script>alert('密码不能为空');window.location.href='../login/index.php';</script>";					
			default:
				die("\$login 没有值");
		}
  	}

		//更新日期
  		function _updateTime($id){
  			$loginTime = strtotime('now');
  			$updateSql = "update vehicle_user set loginTime = {$loginTime} where userId = {$id};";
  			var_dump(($this->mysqli)->query($updateSql));
  		}

  		//更新登陆IP
  		function _updateIp($id){
  			$loginIp = $this->_getIp();
  			var_dump($loginIp);
  			// die;
   			$updateSql = "update vehicle_user set loginIp = '{$loginIp}' where userId = {$id};";
  			var_dump(($this->mysqli)->query($updateSql));
 			
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

/**
 * 订单查询  统计
 */
class order extends mysqlCon{
	function _orderCount($table,$driverId){
		//分别统计  delState 0 1 2 
		$sql = "select driverId,sum(case orderState when '0' then 1 else 0 end) orderF,
									sum(case orderState when '1' then 1 else 0 end) orderS,
									sum(case orderState when '2' then 1 else 0 end) orderT
									from vehicle_order where driverId = '{$driverId}'  ;";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		return $res;		
	}

}

/*
修改个人密码
 */
class pass extends mysqlCon{
	//判断原密码是否存在
	function judpass($driverPwd){
		$driverId = $_SESSION['driverId'];
		$driverPhone = $_SESSION['driverPhone'];
		// var_dump($_SESSION);
		$sql = "select * from vehicle_drivers where driverId = {$driverId} and driverPhone = {$driverPhone} and driverPwd = '{$driverPwd}'";
		$this->_connect();
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败".$this->mysqli->error);
		if (($row = $res->fetch_assoc()) && mysqli_affected_rows($this->mysqli)>0) {
			return true;
		} else {
			return false;
		}

	}

	function updatePass($newpass){
		$driverId = $_SESSION['driverId'];
		$sql = "update vehicle_drivers set driverPwd = '{$newpass}' where driverId = '{$driverId}'";
		$this->mysqli->query($sql) or die('数据库语句执行失败2'.$this->mysqli->error);
		return true;
	}
}


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
	//判断编号是否存在这个表中
	function _judId($id,$table){
		$sql = "select * from {$table} where delState = 1 and existState = 1 and orderId = {$id}";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败".$this->mysqli->error);

		if (mysqli_affected_rows($this->mysqli)>0) {
			$row = $res->fetch_assoc();
			return $row['orderTiNum'];
		} else {
			return false;
		}

	}


	//判断此用户名是否已经创建了并且未被删除delState = 1
	function _judName($userName,$table){
		$sql = "select * from {$table}";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		$Name = false;				
		while (($row = $res->fetch_assoc()) && mysqli_affected_rows($this->mysqli)>0){
			switch ($table) {
				case 'vehicle_user':
					$Uname = 'userName';
					break;				
				default:
					# code...
					break;
			}
			if ($row[$Uname] == $userName && $row['delState'] == 1) {
				$Name = true;
			}
		}
		return $Name;		
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
		$sql = "insert into {$table} ({$keys}) values ({$values});";
		// echo $sql;die;
		$this->mysqli->query($sql) or die("插入语句失败.{$this->mysqli->error}");

		//增加信息成功返回一个true
		return true;
		// echo "<script>alert('信息信息增加成功');location.href='./index.php'</script>";
		}


			//表单信息更改
	function _update($colum,$table,$i = 1){
		$yes = true;
		if ($i == 1) {
			switch ($table) {
				case 'vehicle_order':
			$sql = "update {$table} set goodTrueCount = '{$colum['goodTrueCount']}',driverId = {$colum['driverId']},beginTime = '{$colum['beginTime']}',orderState = 1 where orderId = {$colum['orderId']};";
			break;

				default:
					# code...
					break;
		}
			}else{
			switch ($table) {
				case 'vehicle_order':
			$sql = "update {$table} set lastTime = {$colum['lastTime']},orderState = 2 where orderId = {$colum['orderId']};";
			break;

				default:
					# code...
					break;
		}	
	}
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败{$this->mysqli->error}");
		// echo "数据库语句执行成功";
		return true;
	}
}





//模糊查询
class dimFound extends mysqlCon{
	public $result;
	public $page;

		//$key 搜索内容
		//$table 搜索表
		// 判断模糊搜索得语句,管理员，角色，司机，车辆，商品
		function _select($key,$table,$id){
			
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
				//具体日期范围来搜索，暂时以月份
				$where = $this->_detali($id,$key);
				
			}
			$where .=" and driverId = {$id}";
			$order = " order by orderState, createTime desc";
			$limit = "limit 0,5";
			$sql = "select * from {$table} {$where} {$order} {$limit}";
			$res = $this->mysqli->query($sql) or die("数据库语句执行失败".$this->mysqli->error);
			return $res;
		
	}
	function _detali($driverId,$key){
		$key = ltrim($key,'0');//去除左边的零
		$sql = "select orderId,beginTime,createTime,lastTime from vehicle_order where delState = 1 and existState = 1 and driverId = {$driverId}";
		$res = $this->mysqli->query($sql) or die("数据库语句执行失败".$this->mysqli->error);
		while(($row = $res->fetch_assoc()) && mysqli_affected_rows($this->mysqli)>0){
			if (($key == date('m',$row['beginTime'])) || ($key == date('m',$row['createTime'])) || ($key == date('d',$row['beginTime'])) || ($key == date('d',$row['createTime']))) {
				$colum[] = $row['orderId']; 
			}
		}
		if (!isset($colum)) {
			echo "<script>alert('没有找到相关内容');window.location.href='../order/myOrder.php?a={$driverId}';</script>";die;
		}else{
			$colum = array_unique($colum);
			$str = '';
			foreach ($colum as $key => $value) {
				$str .= "or orderId = '{$value}' ";
			}
			$str ="where (".substr($str, 2).")";
			return $str;		
		}
	}

}


/**
		 * 更新日志
		 */
		class upLOG extends addInfo
		{
				function _up($activity='登录'){
					if (!isset($_SESSION['driverName']) && empty($_SESSION['driverName'])) {
						echo "<script>alert('匹配不到用户名，请登录');location.href='../login/index.php'</script>";
					}
					$colum['userName'] = $_SESSION['driverName'];
					$colum['logIp'] = $this->_getIp();
					$colum['ActivityTime'] = time();
					$colum['Activity'] = $activity;
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