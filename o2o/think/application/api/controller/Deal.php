<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/11
 * Time: 15:18
 */

namespace app\api\controller;
use Request,Db;
use think\Controller;
use app\common\model\Deal as Dea;

class Deal extends Controller
{
    public function changeStatus()
    {
        $id = Request::param('id');
        $status = Request::param('status');

        switch ($status){
            case 0 :    $status = 1;break;
            case -1 :    $status = 0;break;
            case 1 :     $status = -1;break;
        }
       $rows = (new Dea())->updateStatus($id,$status);
        if ($rows !== false) {
            return json(['code'=>1,'msg'=>'状态改变成功']);
        }
        return json(['code'=>0,'msg'=>'状态改变失败']);



    }
}