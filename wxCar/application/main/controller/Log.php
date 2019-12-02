<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/1
 * Time: 10:17
 */
namespace app\main\controller;
use app\main\controller\Base;
use app\common\model\Log as LogModel;
use Request;
class Log extends Base
{
    //显示初始页面
    public function index()
    {
        $logObj = new LogModel();
        $logs = $logObj->getLogs();
        $this->assign('logs',$logs);
        return $this->fetch();
    }

    //删除日志
    public function del()
    {
        $id = Request::param('id');
        $logObj = new LogModel();
        $rows = $logObj->delLog($id);
        if ($rows !== false) {
            return json(['code'=> 1,'msg'=>'删除日志成功']);
        }
        return json(['code'=> 0,'msg'=>'删除日志失败']);
    }

}