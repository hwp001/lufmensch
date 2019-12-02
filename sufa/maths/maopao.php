<?php
//基本思想：
//对需要排序的数组从后往前（逆序）进行多遍的扫描，当发现相邻的两个数值的次序与排序要求的规则不一致时，就将这两个数值进行交换。这样比较小（大）的数值就将逐渐从后面向前面移动。
function maopao($arr){
    $temp = '';
    //如果数组长度小于1 直接返回不排序
    if (count($arr) <= 1) return $arr;
    for ($i=0;$i<count($arr);$i++){  //控制循环次数
        for ($j=0;$j<count($arr)-$i-1;$j++){ //控制循环体
            if ($arr[$j] < $arr[$j+1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
            }
        }
    }
    return $arr;
}
$arr = [4,3,2,5,7];
echo "<pre>";
print_r(maopao($arr));