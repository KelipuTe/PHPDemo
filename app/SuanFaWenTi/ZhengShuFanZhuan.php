<?php
/* ##### 整数反转 ##### */

// 给出一个 32 位的有符号整数，你需要将这个整数中每位上的数字进行反转。
//
// 示例 1:
// 输入: 123
// 输出: 321
//
// 示例 2:
// 输入: -123
// 输出: -321

/**
 * @param Integer $x
 * @return Integer
 */
function reverse($x)
{
    if ($x === 0) {
        return 0;
    }

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

    if ($isPositive && $result > $max32Num - 1) {
        return 0;
    }
    if (!$isPositive && $result > $max32Num) {
        return 0;
    }
    if (!$isPositive) {
        $result = -$result;
    }
    return $result;
}

$x = 120;
$xResult = reverse($x);

echo json_encode($xResult);