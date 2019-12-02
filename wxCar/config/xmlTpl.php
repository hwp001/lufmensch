<?php
//回复消息模板
return [
        'title' => '<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>',
        'text'  => '    <MsgType><![CDATA[text]]></MsgType>
                          <Content><![CDATA[%s]]></Content>
                       </xml>'
];

