<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/16
 * Time: 9:12
 */

namespace app\api\controller;
use think\Controller;
use Request,Db,Session;

/*
 * 发送短信api
 */
class Phone extends Controller
{
    public function sendInfo()
    {
        $phone = Request::param("phone");
        $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
        $code = mt_rand(1000,9999);
        $smsConf = array(
            'key'   => '9d056df0b2e93f41c9933334ea06b814', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '192419', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>"#code#={$code}&#company#=hwp个人项目测试" //您设置的模板变量，根据实际情况修改
                                                                    //左边是随机生成的code   右边是内容
        );

        $content = juhecurl($sendUrl,$smsConf,1); //请求发送短信

        if($content){
            $result = json_decode($content,true);
            $error_code = $result['error_code'];
            if($error_code == 0){
                //状态为0，说明短信发送成功
                Session::set('code',$code);
                return json(["code" => 1]);
            }else{
                //状态非0，说明失败
                $msg = $result['reason'];
                return json(["code" => 0,"msg"=>$msg]);
            }
        }else{
            //返回内容异常，以下可根据业务逻辑自行修改
            return json(["code"=>2,"msg"=>"请求发送短信失败"]);
        }

    }
}