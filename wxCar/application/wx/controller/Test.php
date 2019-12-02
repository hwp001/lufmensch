<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/5
 * Time: 15:06
 */

namespace app\wx\controller;
use app\common\model\Driver;
use app\common\model\Oils;
use Session;
use think\Controller;
use Request,Log;
class Test extends Controller
{
    const TOKEN = 'hwp';
    public function order()
    {
        //获取油品顶级类
        $oils = (new Oils())->getPid();
        if (empty($oils)) {
            $this->error('油品类型暂无，请及时联系管理员');
        }

        $this->assign([
            'oils'   => $oils
        ]);
        return $this->fetch();
    }

    public function index()
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
//        var_dump(123);
        if ($tmpStr == $signature) {
            log::write('验证签名中');
            echo  $echostr;
        } else {
            log::write("验证签名失败");
            echo  false;
        }
    }
}