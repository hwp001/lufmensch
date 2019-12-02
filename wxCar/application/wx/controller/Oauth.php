<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/4
 * Time: 15:24
 */

namespace app\wx\controller;
use app\common\model\Driver;
use app\wx\controller\Base;
use Request,Session;

class Oauth extends Base
{
    const API_CODE = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=STATE#wechat_redirect';
    const API_CODE_TOKEN = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
    const API_GET_USER_INFO = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';

    //index 测试
    public function index()
    {
        return '亲爱的用户，授权登录成功';
    }
    //fail  测试
    public function fail()
    {
        return '亲爱的用户，授权登录失败，账户异常，请及时联系管理员';
    }

    //正确参数配置
    public function wantCode()
    {
        //记得配置微信公众号网页授权 域名
        $redirect_uri = $this->dns.'/wx/oauth/getCode';
        $scope = 'snsapi_userinfo';
        $url = sprintf(self::API_CODE,$this->appid,urlencode($redirect_uri),$scope);
        //进入授权界面
        if (!empty($url)) {
            //只能用重定向，不能用curl
            $this->redirect($url);
        } else {
            return $url."有误";
        }
    }

    //获得code
    public function getCode()
    {
        //get方式获得code
        $code = Request::param('code');
        $this->getToken($code);
    }

    //用code换取网页授权access_token
    public function getToken($code)
    {
        $url = sprintf(self::API_CODE_TOKEN,$this->appid,$this->secret,$code);
        $results = $this->http_request($url);
        if (!empty($results)){
            $this->getUserInfo($results['access_token'],$results['openid']);
        }
    }

    //用网页授权码access_token 获取用户信息
    public function getUserInfo($access_token,$openid)
    {
        $url = sprintf(self::API_GET_USER_INFO,$access_token,$openid);
        $results = $this->http_request($url);
        if (!empty($results)){
//            var_dump($results);
            $driver = new Driver();
            //判断openid是否已经存在 否新增
            $rows = $driver->getInfoByOpenId($results['openid']);
            if (!$rows) {
                $data = [
                    'openid'     => $results['openid'],
                    'name'       => $results['nickname'],
                    'sex'        => $results['sex'],
                    'imageUrl'  => $results['headimgurl'],
                    'city'      => $results['province'].$results['country'].$results['city']
                ];
                //新增用户
                $row = $driver->add($data);
                //判断用户是否新增成功,新增失败跳转失败页面     后面补充返回初始页面
                if (!$row){
                    $this->redirect('fail');die;
//                    var_dump('判断用户是否新增成功');die;
                }
            }
            //判断司机是否被拉黑   被拉黑直接跳转失败页面
            $blackRows = $driver->getBlackInfoByOpenId($results['openid']);
            if ($blackRows != 0) {
                $this->redirect('fail');die;
//                var_dump();die;
            }
            //登录成功直接写入session
            Session::set('openid',$results['openid']);
            $jump = Session::get('jump');
//            var_dump($jump);die;
            if (!empty($jump)) {
                $this->redirect($jump);
            } else {
                echo 'Session::get("jump")没有被定义';
            }

        }
    }


}