<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 14:54
 */

namespace app\wx\controller;
use app\common\model\Oils as Oil;
use think\Controller;
use Request;
class Oils extends Controller
{
    public function category()
    {
        $oilParentName = Request::param('oilP');
        if ($oilParentName !== false) {
            $childCategorys = (new Oil())->getChildByParentName($oilParentName);
            if ($childCategorys !== false){
                return json(['code'=> 1,'value'=>$childCategorys]);
            } else {
                return json(['code'=> 2]);
            }
        }
        return json(['code' => 0]);
    }
}