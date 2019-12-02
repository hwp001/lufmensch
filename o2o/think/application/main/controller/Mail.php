<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/12
 * Time: 15:52
 */

namespace app\main\controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Config;
//邮箱发送
class Mail
{
    private $obj;  //phpMailer  实例
    /*
     * Mail Construt  邮箱初始化
     */
    public function __construct()
    {
        $this->obj = new PHPMailer();
       // $this->obj->SMTPDebug = Config::get("mail.smtp_debug");       //是否开启调试模式
        $this->obj->Host = Config::get("mail.host");                   //邮箱服务器主机地址
        $this->obj->isSMTP();                //使用SMTP协议
        $this->obj->SMTPAuth  = true;      //开启SMTP协议认证
        $this->obj->SMTPSecure = "ssl";   //加密协议
        $this->obj->Username = Config::get("mail.username");  //邮箱服务器用户名
        $this->obj->Password = Config::get("mail.password");  //邮箱服务器密码  也就是授权码
        $this->obj->Port = Config::get("mail.port");            //端口
        $this->obj->isHTML();                                      //内容的格式为html
        $this->obj->setFrom(Config::get("mail.username"));       //发送者用户名
                                                                    //测试发现邮箱用户名和发送者用户名只能为你邮箱名
    }

    /**
     * @param $subject  邮件主题
     * @param $body     邮件内容
     * @param array $receiver   接收者
     * @throws Exception
     */
    public function send($subject, $body, Array $receiver)
    {
        $this->obj->Subject = $subject;    //邮件标题
        $this->obj->Body = $body;           //邮件内容

        foreach ($receiver as $name=>$address) {
            $this->obj->addAddress($address, $name);
        }
        $res = $this->obj->send();  //发送邮件

        if (!$res) {
            //echo $this->obj->ErrorInfo;
        }

    }
}