<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/11
 * Time: 15:18
 */

namespace app\api\controller;
use think\Contrller;
use Request,Db,Session;
class Login extends Request
{
    public function getLoginData()
    {
        if (Session::has("mid")) {
            $mname = Session::get("mname");
            return json(["code" => 1, "data" => $mname]);
        } else {
            return json(["code" => 0]);
        }
    }

    public function logout()
    {
        Session::delete('mid');
        Session::delete('mname');
        return json(['code' => 1]);
    }
}