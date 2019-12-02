<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/15
 * Time: 9:29
 */

namespace app\main\controller;
use app\main\validate\RecommandValidate;
use app\main\controller\Base;
use app\common\model\Recommand as reco;
use Config,Request;
class Recommand extends Base
{
    //推荐位列表
    public function index()
    {
        return $this->fetch();
    }

    //添加推荐位
    public function add()
    {
        //判断是否为post请求
        if (Request::isPost()) {
            //获取推荐位数据
            $data = Request::param();
            //实例化验证器
            $recommandVali = new RecommandValidate();
            if ($recommandVali->check($data)) {
                $data['status'] = 0;
                $data['delete_time'] = 0;
                $row = (new reco())->add($data);
                if ($row) {
                    $this->success('添加成功','recommand/index');
                }
            }
            //如果验证失败
            $this->error('添加失败');
        }
        //获取推荐位
        $types = Config::get("recommand.");
        $this->assign('types',$types);
        return $this->fetch();
    }
}