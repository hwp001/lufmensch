<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/11
 * Time: 10:23
 */

namespace app\api\controller;
use think\Controller;
use Request,Log;

/**
 * 图片上传
 * @package app\api\controller
 */
class Image extends Controller
{
    public function upload()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');  //资源名字
        Log::write($file);
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move( './uploads');
        if($info){
            // 成功上传后 获取上传信息
            $path =  $info->getSaveName();
            return json(["path" => $path]);
        }else{
            // 上传失败获取错误信息
            return json(["error" => $file->getError()]);
        }
    }
}