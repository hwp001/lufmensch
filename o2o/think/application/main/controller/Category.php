<?php
namespace app\main\controller;
use app\main\controller\Base;
use think\facade\Request;
use app\main\validate\CategoryVali;
/**
 * 生活分类业务逻辑
 * @package app\main\controller
 */
class Category extends Base
{
    private $obj;//存储模型实例
    protected function initialize(){
        $this->obj = new \app\common\model\Category;
    }

    //显示生活服务分类
    public function index()
    {
       //获取顶级的分类数据
        $categorys = $this->obj->getFirstCategory(0,true);
        $page = $categorys->render();     //用这种办法可以将需要分页的数据单独弄出来，分页直接渲染对象就可以了，没有分页则返回数组  推荐使用
        //模板赋值
        $this->assign([
            "categorys" => $categorys,
                "page"  => $page,
        ]);
        return $this->fetch();
    }

    //添加分类
    public function add()
    {
        if (Request::isPost()){
            $data = Request::param();  //$data返回的是一个数组
            $categoryVali = new CategoryVali();
            if ($categoryVali->check($data)) {
               if ($this->obj->add($data)) {
                   $this->success('数据添加成功','index');
               }
            }
            $this->error($categoryVali->getError());
        }
        //获取有层级的分类数据
        $categorys = $this->obj->getTreeCategory();
        $this->assign("categorys",$categorys);
        return $this->fetch();
    }

    //获取子栏模块
    public function getSubCategory()
    {
        //获取父级Id
        $parentId = Request::param("parent_id");
        $categorys = $this->obj->getFirstCategory($parentId,true);
        $page = $categorys->render();
        //模板赋值，模板渲染
        $this->assign([
            "categorys" => $categorys,
            "page"  => $page,
        ]);
        return $this->fetch('index');
    }

    //修改状态
    public function setStatus()
    {
        $id = Request::param("id");
        $status = Request::param("status");
        $res = $this->obj->updateStatus($id, $status);
        if ($res) {
            $this->redirect(url("index"));
        }
        $this->error("修改状态失败");
    }

    //修改数据
    public function edit()
    {
        if (Request::isPost()) {
            //获取数据
            $data = Request::param();

            //实例化验证器
            $categoryVali = new CategoryVali();
            if ($categoryVali->check($data)) {
                $res = $this->obj->updateCategory($data);
                if ($res !== false) {
                    $this->success("更新成功", url("index"));
                } else {
                    $this->error("更新失败");
                }
            }
            $this->error($categoryVali->getError());
        }

        //获取id
        $cid = Request::param("id");
        $category = $this->obj->getCategoryById($cid);

        //获取有层级的分类数据

        $categorys = $this->obj->getTreeCategory();
        $this->assign([
            "category" => $category,
            "categorys" => $categorys,
            ]);
        return $this->fetch();
    }

    //对数据进行软删除
    public function del()
    {
        //获取id
        $id = Request::param('id');
//        var_dump($id);die;
        $res = $this->obj->delCategory($id);
//        var_dump($res);die;
        if ($res !== false) {
            $this->success('删除成功',url('index'));
        } else {
            $this->error('删除失败');
        }
    }
}







