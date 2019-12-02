<?php
//快速排序 基本思想：
//    在数组中挑出一个元素（多为第一个）作为标尺，扫描一遍数组将比标尺小的元素排在标尺之前，将所有比标尺大的元素排在标尺之后，
//通过递归将各子序列分别划分为更小的序列直到所有的序列顺序一致。

function quick_sort($arr)
{
    //先判断是否需要继续进行
    $length = count($arr);
    if ($length <= 1) {
        return $arr;
    }
    $base_num = $arr[0];//选择第一个元素作为标尺
    //初始化两个数组
    $left_array = array();//小于标尺
    $right_array = array();//大于标尺
    for ($i=1;$i<$length;$i++){
        //遍历 除了标尺外的所有元素，按照大小关系放到数组里面去
        if ($base_num > $arr[$i]){
            //放入左边数组
            $left_array[] = $arr[$i];
        } else {
            //放入右边的数组
            $right_array[] = $arr[$i];
        }
    }
    //在分别对 左边 和 右边的数组进行相同的排序处理方式
    //递归调用这个函数，并记录结果
    //左右两边有数据才进行递归调用
    if (count($left_array) > 1){
        $left_array = quick_sort($left_array);
    }
    if (count($right_array) > 1){
        $right_array = quick_sort($right_array);
    }
    //合并左边 标尺 右边
    return array_merge($left_array,array($base_num),$right_array);
}

$arr = [4,3,5,8,6,20,17,1];
echo "<pre>";
print_r(quick_sort($arr));