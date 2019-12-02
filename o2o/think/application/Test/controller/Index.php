<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/18
 * Time: 20:48
 */
namespace app\test\controller;
use think\Controller;
use app\common\model\Test;
class index extends Controller
{
    public function index()
    {
            $test = (new Test())->getAll();
            foreach($test as $v) {
                $avg[] = $v['count'];
                $atime[] = date('Y.m.d h:i',$v['xtime']);
            }
            //去除转换为json数据时候会出现的错误
//            $atime=json_encode($atime,true);
//            $atime=str_replace('"', '', $atime);
//            $atime=str_replace('[', '', $atime);
//            $atime=str_replace(']', '', $atime);
//            $avg=json_encode($avg,true);
//            $avg=str_replace('[', '', $avg);
//            $avg=str_replace(']', '', $avg);
            //渲染
            $atime=json_encode($atime,true);
            $avg=json_encode($avg,true);
            $this->assign([
                'avg' => $avg,
                'atime' => $atime
            ]);
            return $this->fetch();

    }

    //测试渲染不通的视图
    public function abd()
    {
        $a = 'hello';
        $this->assign('a',$a);
        return $this->fetch('hello');
    }
}