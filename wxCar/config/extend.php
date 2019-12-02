<?php
//存放回复消息的数据格式
return [
    //文本消息格式
    'text' =>  '<xml>
                       <ToUserName><![CDATA[%s]]></ToUserName>
                       <FromUserName><![CDATA[%s]]></FromUserName>
                       <CreateTime>'.time().'</CreateTime>
                       <MsgType><![CDATA[text]]></MsgType>
                       <Content><![CDATA[%s]]></Content>
                 </xml>',
    //图片消息格式
    'image' => '<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>.time().</CreateTime>
                      <MsgType><![CDATA[image]]></MsgType>
                      <Image>
                        <MediaId><![CDATA[%s]]></MediaId>
                      </Image>
                 </xml>',
    //图文消息
    'news' => [
        //图文消息的头部
        'head' => '<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>'.time().'</CreateTime>
                      <MsgType><![CDATA[news]]></MsgType>
                      <ArticleCount>%s</ArticleCount>
                      <Articles> ',
        //图文消息的主体
        'body' => '<item>
                       <Title><![CDATA[%s]]></Title>
                       <Description><![CDATA[%s]]></Description>
                       <PicUrl><![CDATA[%s]]></PicUrl>
                       <Url><![CDATA[%s]]></Url>
                    </item>',
        //图文消息尾部
        'foot' => ' </Articles>
                    </xml>',
    ],

];