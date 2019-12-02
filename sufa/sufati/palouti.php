<?php
/*//爬楼梯
function climbStairs($n) {
    if ($n == 1) return 1;
    if ($n == 2) return 2;
    return climbStairs($n - 1) + climbStairs($n - 2);
}

echo climbStairs(4);*/

//爬楼梯
function climbStairs($n) {
    if ($n < 3) return $n;
    $one = 1;
    $two = 2;
    for ($i = 3;$i <= $n;$i++){
        $curren = $one + $two;
        $one = $two;
        $two = $curren;
    }
    return $curren;
}
echo climbStairs(4);