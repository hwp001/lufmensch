<?php
//二分查找基本思想：
//    假设数据是按升序排序的，对于给定值x，从序列的中间位置开始比较，如果当前位置值等于x，则查找成功；若x小于当前位置值，则在数列的前半段中查找；若x大于当前位置值则在数列的后半段中继续查找，直到找到为止。（数据量大的时候使用）

function bin_search($arr,$low,$high,$k)
{
    if ($low <= $high){
        $mid = intval(($low+$high)/2);
        if ($arr[$mid] == $k){
            return $mid;
        } else if ($k < $arr[$mid]){
            return bin_search($arr,$low,$mid-1,$k);
        } else {
            return bin_search($arr,$mid+1,$high,$k);
        }
    }
    return -1;
}

$arr = [1,2,3,4,5,6,7,8,9,10];
print(bin_search($arr,0,9,11)+1);