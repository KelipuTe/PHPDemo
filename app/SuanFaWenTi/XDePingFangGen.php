<?php
/* ##### x 的平方根 ##### */

// 实现 int sqrt(int x) 函数。
// 计算并返回 x 的平方根，其中 x 是非负整数。
// 由于返回类型是整数，结果只保留整数的部分，小数部分将被舍去。
//
// 示例 1:
// 输入: 4
// 输出: 2
//
// 示例 2:
// 输入: 8
// 输出: 2
// 说明: 8 的平方根是 2.82842...,
//      由于返回类型是整数，小数部分将被舍去。

/* ##### 代码 ##### */

/**
 * @param Integer $x
 * @return Integer
 */
function mySqrt($x)
{
    $left = 0;
    $right = intval($x / 2) + 1;
    while ($left <= $right) {
        $middle = intval(($left + $right) / 2);
        if ($middle * $middle < $x) {
            if (($middle + 1) * ($middle + 1) > $x) {
                return $middle;
            }
            $left = $middle + 1;
        } else if ($middle * $middle > $x) {
            if (($middle - 1) * ($middle - 1) < $x) {
                return $middle - 1;
            }
            $right = $middle - 1;
        } else {
            return $middle;
        }
    }
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$testList = [0, 1, 2, 4, 8, 15, 18, 35];
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = mySqrt($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => round(($timeStop - $timeStart) / count($testList), 2),
    'result'    => $resultList
];
echo json_encode($echo);

