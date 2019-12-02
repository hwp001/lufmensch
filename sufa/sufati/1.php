<?php
//给定一个只包括 '('，')'，'{'，'}'，'['，']' 的字符串，判断字符串是否有效。
//
//有效字符串需满足：
//
//左括号必须用相同类型的右括号闭合。
//左括号必须以正确的顺序闭合。
//注意空字符串可被认为是有效字符串。
//

function isVali($input)
{
    //压栈，栈匹配
    $arr = ['(' => ')','[' => ']','{' => '}'];
    $stack = [];
    for ($i = 0;$i < strlen($input);$i++){
        if (isset($arr[$input[$i]])){
            $stack[] = $input[$i];
        } else {
            $vali = array_pop($stack);
            if ($arr[$vali] != $input[$i]){
                return false;
            }
        }
    }
    return $stack?false:true;
}

$str = '(]';
var_dump(isVali($str));

