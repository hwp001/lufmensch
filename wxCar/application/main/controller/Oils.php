<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/2
 * Time: 13:16
 */

namespace app\main\controller;
use app\main\controller\Base;
use app\common\model\Oils as Oil;
use app\common\validate\OilsValidate;
use Request,Log;

class Oils extends Base
{
    public function index()
    {
        $Oils = new Oil();
        //获取所有非顶级分类
        $oil = $Oils->getOils();
        //将pid 改成 所属分类
        foreach($oil as $k => $v){
            $oil[$k]['pid'] = $Oils->getOilsFa($v['pid']);
        }
//        var_dump($oil);die;
        $this->assign([
            'oils' => $oil
        ]);
        return $this->fetch();
    }

    //新增
    public function add()
    {
        $Oils = new Oil();
        if (Request::isPost()) {

            if (Request::param('pidName')) {
                $data = [
                    'name' => Request::param('pidName'),
                    'pid'  => 0,
                ];
            } else {
                $data = Request::param();
                $data = [
                    'name'       => $data['name'],
                    'pid'        => $data['pid'],
                    'count'      => $data['count'],
                    'trueCount' => $data['trueCount'],
                    'state'      => $data['state']
                ];
            }
            var_dump($data);
            //检验油品类名不弄重复
            $OilsVali = new OilsValidate();
            if($OilsVali->check($data)){
                $rows = $Oils->add($data);
                if ($rows !== false) {
                    $this->success('新增油品成功','index');
                } else {
                    $this->error('新增油品失败');
                }
            } else {
                $this->error($OilsVali->getError());
            }
        }
        $oils = $Oils->getPid();
        $this->assign([
            'oils' => $oils
        ]);
        return $this->fetch();
    }

    //分类
    public function category()
    {
        $oilParentName = Request::param('oilP');

        if ($oilParentName) {
            $childCategorys = (new Oil())->getChildByParentName($oilParentName);
            log::Write($childCategorys);
            if ($childCategorys !== false){
                return json(['code'=> 1,'value'=>$childCategorys]);
            } else {
                return json(['code'=> 2]);
            }
        }

        return json(['code' => 0]);
    }
}