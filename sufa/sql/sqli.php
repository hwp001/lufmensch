<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/28
 * Time: 21:45
 */
header('content-type=html/text;charset=utf-8');
class sqli
{
    private  $host;  //域名
    private  $db;    //数据库
    private  $db_user;  //用户名
    private  $db_pwd;   //密码
    public   $mysqli;   //连接对象
    public function __construct(){
        $this->host = '127.0.0.1:3306';
        $this->db = 'php';
        $this->db_user = 'root';
        $this->db_pwd = 'hwp';
        //连接对象为空，则连接数据库
        if (!$this->mysqli) {
            $this->_connect();
        }
    }
    //连接数据库
    protected function _connect(){
        $this->mysqli = new mysqli($this->host,$this->db_user,$this->db_pwd,$this->db) or die('数据库连接失败');
        $this->mysqli->query('set names utf8');
    }
}

//查询
class queryStam extends sqli{
    public function queryAll($table){
        $sql = "select * from {$table}";
        $result = $this->mysqli->query($sql);
        if (!$result) {
            return "{$table} is null";
        }
        //测试输入一行
        $res[] = $result->fetch_fields();
//        $res[] = $result->fetch_row();
        return $res;
    }
}
$hello = new queryStam();
echo "<pre>";
print_r($hello->queryAll("test"));