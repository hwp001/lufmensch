<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/4
 * Time: 10:03
 */

namespace app\wx\controller;
use app\wx\controller\Base;
use app\wx\controller\Menu;
use Request,Log,Config;
class Wx extends Base
{
    const TOKEN = 'hwp';

    //验证令牌签名
    public function verfiToken()
    {
        //微信加密签名
        $signature = Request::param('signature');
        //时间戳
        $timestamp = Request::param('timestamp');
        //随机数
        $nonce     = Request::param('nonce');
        //随机字符串
        $echostr   = Request::param('echostr');
        //验证令牌
        $tmpArr = [$nonce,$timestamp,self::TOKEN];
        sort($tmpArr,SORT_STRING);
        $tmpStr =  sha1(implode($tmpArr));
        if ($tmpStr == $signature) {
            log::write('验证签名中');
            echo  $echostr;
        } else {
            log::write("验证签名失败");
            echo  false;
        }
    }

    //消息回复
    public function response($content='欢迎来到王者荣耀')
    {
        //消息回复       目前回复简单文本信息  （图文 音乐 图片后期增加）
        $data = file_get_contents("php://input");
        if (empty($data)) {
            return '域名接入成功，请到公众号测试';
        }
        //将xml数据转换为对象
        $xmlObj = simplexml_load_string($data,'SimpleXMLElement', LIBXML_NOCDATA);
        $ToUserName = $xmlObj->ToUserName;
        $FromUserName = $xmlObj->FromUserName;
        return sprintf(config::get('xmlTpl.title').config::get('xmlTpl.text'),$FromUserName,$ToUserName,time(),$content);
    }
}