<?php
class judRoot{
	//权限限制
	function _judRootoot(){		
		$roleId =  $_SESSION['roleId'];
		$judCon = new mysqlCon();
		$judCon->_connect();
		$where = "where roleId = {$roleId} and delState = 1"; 
		$res = $judCon->select('vehicle_role',$where);
		$row = $res->fetch_assoc();
		$rootName =  explode('@', $row['rootName']);
		foreach ($rootName as $value) {		
			switch ($value) {
				case 'edit':
					$root['edit'] = 1;
					break;
				case 'add':
					$root['add'] = 1;
					break;
				case 'delete':
					$root['delete'] = 1;
					break;
				case 'allFunction':
					$root['edit'] = 1;
					$root['add'] = 1;
					$root['delete'] = 1;
					break;
				case 'allObject':
					$root['role'] = 1;
					$root['good'] = 1;
					$root['driver'] = 1;
					$root['log'] = 1;
					$root['logs'] = 1;
					$root['node'] = 1;				
					$root['car'] = 1;
					$root['order'] = 1;					
					break;	
				case 'role':
					$root['role'] = 1;
					break;
				case 'good':
					$root['good'] = 1;
					break;
				case 'driver':
					$root['driver'] = 1;
					break;
				case 'log':
					$root['log'] = 1;
					break;
				case 'logs':
					$root['logs'] = 1;
					break;
				case 'node':
					$root['node'] = 1;
					break;
				case 'car':
					$root['car'] = 1;
					break;
				case 'order':
					$root['order'] = 1;
					break;
				default:

					break;
			}
		}

		return $root;
	 }
	 //编辑角色页面显示权限
	 function _rootEdit($id){
			$Role = new mysqlCon();
			$Role->_connect();
			$where = "where roleId = {$id} and delState = 1"; 
			$res = $Role->select('vehicle_role', $where);
			$row = $res->fetch_assoc();
			$rootName =  explode('@', $row['rootName']);
			$check['edit'] = $check['add'] = $check['delete'] = $check['allFunction'] = $check['allObject'] = '';
			$check['role'] = $check['good'] = $check['driver'] = $check['log'] = $check['node'] =$check['car'] = $check['order'] = '';
			$check['roleName'] = $row['roleName'];
			        foreach ($rootName as $value) {     
			            switch ($value) {
			                case 'edit':
			                    $check['edit'] = 'checked';
			                    break;
			                case 'add':
			                    $check['add'] = 'checked';
			                    break;
			                case 'delete':
			                    $check['delete'] = 'checked';
			                    break;
			                case 'allFunction':
			                    $check['allFunction'] = 'checked';
			                    break;
			                case 'allObject':              
			                    $check['allObject'] = 'checked';       
			                    break;  
			                case 'role':
			                    $check['role'] = 'checked';
			                    break;
			                case 'good':
			                    $check['good'] = 'checked';
			                    break;
			                case 'driver':
			                    $check['driver'] = 'checked';
			                    break;
			                case 'log':
			                    $check['log'] = 'checked';
			                    break;
			                case 'node':
			                    $check['node'] = 'checked';
			                    break;
			                case 'car':
			                    $check['car'] = 'checked';
			                    break;
			                case 'order':
			                    $check['order'] = 'checked';
			                    break;
			                default:

			                    break;
			            }
			        }
					return $check;
				 }
			
}



// $root = new _judRoot();
// $r = $root->_Root();
// echo "<pre>";
// print_r($r);