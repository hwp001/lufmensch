<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/3
 * Time: 16:20
 */

namespace app\wx\controller;
use think\cache\driver\Memcache;
use think\Controller;

class Base extends Controller
{

    protected $appid  = '';
    protected $secret = '';
    public $access_token = '';

    //外网手动输入
    public $dns = "http://gm9n56.natappfree.cc";

    public function __construct()
    {
        $this->appid  = 'wx3920441e4f518e46';
        $this->secret = 'b67317abc4b5c887311fad7b252c591e';
        //动态获取access_token
        $this->access_token = $this->accessToken();
    }

    //动态获取access_token
    public function accessToken()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->secret.'';
        //实例化memcache缓存
        $memcache = new Memcache();
        //连接服务端
        $memcache->connect('127.0.0.1',11211);
//        $true = $memcache->flush();
//        var_dump($true);die;
          //判断access_token是否失效
            $expires_in = $memcache->get('expires_in');
        if (($expires_in+5000) < time()) {
            $accessToken = $this->http_request($url);
            $result1 = $memcache->replace( 'access_token', $accessToken['access_token']);
            $result = $memcache->replace( 'expires_in', time());
            if( $result == false ) {
                $memcache->set('access_token', $accessToken['access_token']);
            }
            if ($result1 == false) {
                $memcache->set('expires_in',time());
            }
        }
        $access_token = $memcache->get('access_token');
        $memcache->close();
        return $access_token;
    }

    /**发送请求
     * @param $url  请求路径
     * @param string $data  发送数据
     * @return mixed|string  返回数据结果为数组
     */
    public function http_request($url,$data="")
    {
        //初始化
        $ch = curl_init();
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        //这两行取消ssl验证
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        //设置内容返回或者直接输出 跟 curl_exec()结合使用
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //判断是否有数据要发送
        if (!empty($data)) {
            //模拟post提交数据
            curl_setopt($ch,CURLOPT_POST,1);
            //将数据包裹
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }
        $output = curl_exec($ch);
        if ($output == FALSE) {
            return "curl 错误信息:".curl_error($ch);
        }
        curl_close($ch);
        //以数组方式返回数据
        $output = json_decode($output,true);
        return $output;
    }
}