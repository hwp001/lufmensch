<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/9
 * Time: 22:36
 */

namespace app\main\controller;
use app\main\controller\Base;
use think\facade\Request;
use app\main\validate\CityValidate;
/**
 * 城市管理分类
 * @package app\main\controller
 */
class City extends Base
{
    private $obj;//存储模型实例
    protected function initialize(){
        $this->obj = new \app\common\model\City;
    }

    //显示刚开始得城市列表
    public function index()
    {
        //获取顶级的分类数据
        $citys = $this->obj->getFirstCity(0,true);
        $page = $citys->render();     //用这种办法可以将需要分页的数据单独弄出来，分页直接渲染对象就可以了，没有分页则返回数组  推荐使用
        //模板赋值
        $this->assign([
            "citys" => $citys,
            "page"  => $page,
        ]);
        return $this->fetch();
    }

    //添加分类
    public function add()
    {
        if (Request::isPost()){
            $data = Request::param();  //$data返回的是一个数组
            $cityValidates = new CityValidate();
            if ($cityValidates->check($data)) {
                if ($this->obj->add($data)) {
                    $this->success('数据添加成功','index');
                }
            }
            $this->error($cityValidates->getError());
        }
        //获取有层级的分类数据
        $citys = $this->obj->getTreeCity();
        $this->assign("citys",$citys);
        return $this->fetch();
    }


    //修改数据
    public function edit()
    {
        if (Request::isPost()) {
            //获取数据
            $data = Request::param();

            //实例化验证器
            $cityValidates = new CityValidate();
            if ($cityValidates->check($data)) {
                $res = $this->obj->updateCity($data);
                if ($res !== false) {
                    $this->success("更新成功", url("index"));
                } else {
                    $this->error("更新失败");
                }
            }
            $this->error($cityValidates->getError());  //验证器处理异常机制
        }

        //获取id
        $cid = Request::param("id");
        $city = $this->obj->getCityById($cid);

        //获取有层级的分类数据
        $citys = $this->obj->getTreeCity();
        $this->assign([
            "city" => $city,
            "citys" => $citys,
        ]);
        return $this->fetch();
    }

    //获取子栏模块
    public function getSubCity()
    {
        //获取父级Id
        $parentId = Request::param("parent_id");
        $citys = $this->obj->getFirstCity($parentId,true);
        $page = $citys->render();
        //模板赋值，模板渲染
        $this->assign([
            "citys" => $citys,
            "page"  => $page,
        ]);
        return $this->fetch('index');
    }

    //对数据进行软删除
    public function del()
    {
        //获取id
        $id = Request::param('id');
        $res = $this->obj->delCity($id);
        if ($res !== false) {
            $this->success('删除成功',url('index'));
        } else {
            $this->error('删除失败');
        }
    }

}