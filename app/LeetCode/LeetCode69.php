<?php
/* ##### x 的平方根 ##### */

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
            if (($middle + 1) * ($middle + 1) > $x) return $middle;
            $left = $middle + 1;
        } else if ($middle * $middle > $x) {
            if (($middle - 1) * ($middle - 1) < $x) return $middle - 1;
            $right = $middle - 1;
        } else {
            return $middle;
        }
    }
}

/* 测试代码 */

$testList = [0, 1, 2, 4, 8, 15, 18, 35];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = mySqrt($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);

