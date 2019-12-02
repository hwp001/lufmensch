<?php
//顺序查找基本思想：
//
//从数组的第一个元素开始一个一个向下查找，如果有和目标一致的元素，查找成功；如果到最后一个元素仍没有目标元素，则查找失败!
function seq_search($arr,$n,$k)
{
    $array[$n] = $k;
    for ($i = 0;$i < $n;$i++){
        if ($arr[$i] == $k){
            break;
        }
    }
    if ($i < $n){
        return $i;
    } else {
        return -1;
    }
}

$arr = [1,2,3,4,5];
echo "<pre>";
print_r(seq_search($arr,5,3));