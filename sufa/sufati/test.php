<?php

function isVali($input)
{
    $arr = ['(' => ')','{' => '}','[' => ']'];
    $stack = [];
    for ($i = 0; $i < strlen($input); $i++){
        //若 左括号 则压栈 否 则出栈匹配
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

$str = "{[]}";
var_dump(isVali($str));