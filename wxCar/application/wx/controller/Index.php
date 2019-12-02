<?php
namespace app\wx\controller;
use think\Controller;
use app\wx\controller\Wx;
use Request,Log,Config;
class Index extends Controller
{

    //微信入口
    public function index()
    {
        //实例化微信功能类
        $wx = new Wx();
        //随机字符串 判别验证令牌 or 开发模式
        if (isset($_GET['echostr'])){
            //令牌验证
             $wx->verfiToken();
        } else {
            $content = '欢迎光临';
            echo $wx->response($content);
        }

    }







}
