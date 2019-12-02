<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/11/4
 * Time: 10:11
 */

namespace app\wx\controller;
use app\wx\controller\Base;
use think\cache\driver\Memcache;

/*
 * 自定义菜单
 */
class Menu extends Base
{
    const API_MENU = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=';
    const API_GET_MENUS = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=';
    //初始化菜单
    public function index()
    {


        $data = [
           [
               "type"=>"view",
               "name" =>"排队查询",
               "url" => $this->dns."/wx/logic/line"
           ],
            [
                "type"=>"view",
                "name"=>"预约装车",
                "url" => $this->dns."/wx/logic/order"
            ],
            [
                "type"=>"view",
                "name"=>"个人中心",
                "url" => $this->dns."/wx/logic/mine"
            ]
        ];
        $matchRule = [
            "sex"=> "1",
            "client_platform_type"=> "2",
            "language"=> "zh_CN"
        ];
        var_dump($this->access_token);
        $url = self::API_MENU.$this->access_token;
        $results = $this->http_request($url,json_encode(['button'=>$data,'matchrule'=>$matchRule],JSON_UNESCAPED_UNICODE));
        //判断菜单是否成功建立
        var_dump($results);
    }

    //查询菜单
    public function getMenus()
    {
        $url = self::API_GET_MENUS.$this->access_token;
        $results = $this->http_request($url);
        echo "<pre>";
        print_r($results);
    }

}