<?php
/* LeetCode7 整数反转 */

/**
 * @param Integer $x
 * @return Integer
 */
function reverse($x)
{
    if ($x === 0) return 0;
    $numArr = [];
    $max32Num = 2147483648;
    $isPositive = true;

    if ($x < 0) {
        $isPositive = false;
        $x = -$x;
    }
    while ($x > 0) {
        $numArr[] = $x % 10;
        $x = intval($x / 10);
    }

    $numLength = count($numArr);
    $numPow = pow(10, $numLength - 1);
    $result = 0;
    for ($i = 0; $i < $numLength; $i++) {
        if ($numArr[$i] === 0) {
            $numPow = intval($numPow / 10);
            continue;
        }
        $result += $numArr[$i] * $numPow;
        $numPow = intval($numPow / 10);
    }

    if ($isPositive && $result > $max32Num - 1) return 0;
    if (!$isPositive && $result > $max32Num) return 0;
    if (!$isPositive) $result = -$result;
    return $result;
}

/* 测试代码 */

$testList = [120];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = reverse($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);