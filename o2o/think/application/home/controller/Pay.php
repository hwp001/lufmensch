<?php
/**
 * Created by PhpStorm.
 * User: hwpoo
 * Date: 2019/10/17
 * Time: 14:42
 */

namespace app\home\controller;
use think\Controller;
use Request,Session,Db;
use app\common\model\Order;
use Yansongda\Pay\Pay as Pa;
use Yansongda\Pay\Log;
/**
 * 支付
 * @package app\home\controller
 */
class Pay extends Controller
{
    //alipay支付参数
    protected $aliconfig = [
        'app_id' => "2016101300675734",
        //支付中跳转
        'notify_url' => 'http://jrwi9m.natappfree.cc/home/pay/notify',
        //支付成功跳转
        'return_url' => 'http://tp52.com/home/pay/alireturn',
        'ali_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlvQh3F9rqYWJ9xq6qcZiugxT33ulxl+nKqGdwcj5mqc1mRI24hcFHaFHI9vq68EjAFl8ik+954di01OFhmIurxoeAvfUb/T/2ihNf2d2XKlo2noQOlmJTT2nhfMhwo/lGZESlhM6EfGROORjWOpRI3bRKMjPLwg4qPqZ9eMVX/W5Uhgy3XoPKHFEx4lJFXXe4sKFrS8yNdsHxzhuBbBHdBvwuxjjOfmTd6rsyTvxByGARWmfhX5XYbg//rjF828tGgMbrJlwwWQLWYr7bwtZcZbvhTeOqC2WyB2/kXethWX0mK8KpVxdIQvxatdieem8BerVy8AMCWyt7WHGBiWD+QIDAQAB",
        // 加密方式： **RSA2**
        'private_key' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCy5WqVOez4AYqSJboYjT3WZH8K6tYPdI+BS53pqXphlOIWLJComDQm+6aoyiLXTY620DlfDj3vvmU27qf2G0NbJqUKPvE1zQEHpL/WB4NhzxJwyp9phf550eJM61Cyei3mtiuzfoLhq0mZgi4dCok5GwNfWAMW8g4Ggenp72iFFG2KOLbK6QEr6eE+FsLKcWvDPe6BHTP7C3H8H31DwVL7b/rIf6buJn/DHnPrFOEl0j0f7RQZsubk98i9uHvaeFr6frgSOBXskDLlhyIZpSGhPticBjI84NnvmvIcNH7Y00n7gM2AkvNRdrCS/bhIaN2Hkt0FRJy4haCApccIKxHRAgMBAAECggEAU/+MkAzmy3xNyFmWi7il9Gizjji90fv09cy/lNtS70as8aRzN/ZfZn56vn5K5bUw8X3LsmpJgqxvcd+VVeVvNvlqPOlY8N4VQbWFrcVRVzeXfQZm23FjD2gRTfSfq23a551Z36njYnq+0Clj5Zbw37NjXf1BViDJnRya7JDRDsrCfqTYNTe1DQiYOPwIzVbz66L7gvKHYT/gMF3TfdzmCwy0bfru2tSg+MNawD9Yy1DIBz0MqHyQsTeo2XY5yRalz2k1tqi5FkbmPHrx/655S9xNOphe4uko+eC+aU4FsuBYW1vpGttEPvjabZLnFEcxJK/lvOm3D19TZaTQNGupAQKBgQDvJxsNquHD6YZehr+fJLCXuytaR63nVlp8ngEkOe2DcujLAR22ZSPbXb9vQlGp/CPZIk3tC2IygoQWIVa0z9ejZNvkkkv2qt/8nGFZ9Cs90/lAOBiiemyytLjzJZ8dVpckcpTc+f/DLeIqbBDWotdRv45kIyOm8RAi0rADD2K7OQKBgQC/f6PGyoHQGsZ/ztTx2ohYwIC7pDyqa3YDTwb9EDacYxGOh4eAnCYd+oQXw3dvYPl4DnvyRAwk6Z7GM6I1QrqurrOnrMrycNeKjFt4ZJC+NnJ6FYwdOeJvJk2lCB3su3RTF/Goymx2CQyb7aT/ZzjIz/ZGqVzb4W2uWxC0WsjTWQKBgQC4MXpYsIBqD/Z533a+79dDRdlCE2sRfiT7Tga7DBKu51X85MMptARF9JJ48q9LKPPDTPSP2fCrznJFSTAq2tnO8uOZzEPNnBYfzaH9Ul3rpNOYbpwqp/gIO8EnJJbEVejbHZUiDTq77R8AZXMinRER2WOmJJpU/d3btEH0WWlFoQKBgGFdGz8SbUgKpQwMdDZ3fsVpMsq0qWeYdYsfHhWCrdF7iUynWdypB7RMT+bpKguGCbDh5GD7+hS2d1ScogdkYxg3mP5Sm2kCuIQn8sXWk8UyV6f81p1xddA/cFDNPLHFaVJqJSNFsDmfRjrta+uzZqqrGbM5nw3oouR4Rpj8Y4kZAoGAbUJKWeCqLcl+mBxr1ZrsLbJLU4+ptjiX/cKfVBxht4cmmS1Q4+kbxl04N3OS39pm/DgxfzReQT8BcHnGxM/R3uMm3pT6BWeIDJIhnlcRzV5nAQ5OcjGr1uuDnA8zuBDjZKHRBL1bbdVCAssmvmXpKfs5D3BPlBwMTeORwNPk08o=',
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];



    //选择支付方式
    public function pay()
    {
        $paycode = Request::param("paycode");
        $oid = Request::param("oid");
        Db::name("order")->where("id",$oid)->update(["pay_type"=>$paycode]);
        $order = (new Order())->getOrder($oid); //根据id订单数据
        if ($paycode == 'alipay') {
            $this->alipay($order);
        } elseif ($paycode == 'weixin') {
            $this->error('微信服务暂时未开通');
        }
    }

    //阿里支付
    public function alipay($orderData)
    {
        //一些基本的信息提示
        $order = [
            'out_trade_no' => $orderData['out_trade_no'],
            'total_amount' => $orderData['pay_amount'],
            'subject' => 'o2o团购',
        ];
        $alipay = Pa::alipay($this->aliconfig)->web($order);
        return $alipay->send();
    }

    //支付宝付款后跳转页面
    public function alireturn()
    {
        return '您已支付成功，等待收货';
    }

    //阿里支付异步通知
    public function notify()
    {
        $alipay = Pa::alipay($this->aliconfig);
        try{
            $data = $alipay->verify(); //验签
            $data = $data->toArray();
            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            $outTradeNo = $data["out_trade_no"]; //获取的到支付宝的订单编号
            $count = Db::name("order")->where("out_trade_no", $outTradeNo)->count();
            if ($count <= 0) {
                throw new \Exeception("订单编号不一致");
            }
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况
            Db::name('order')->where("out_trade_no",$outTradeNo)->update(['pay_status'=>1,'pay_time'=>strtotime(time())]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $alipay->success()->send();
    }
}




