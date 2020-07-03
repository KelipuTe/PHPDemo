<?php
/* LeetCode9 回文数 */

/**
 * @param Integer $x
 * @return Boolean
 */
function isPalindrome($x)
{
    if ($x < 0) return false;

    $numArr = [];
    while ($x > 0) {
        $numArr[] = $x % 10;
        $x = intval($x / 10);
    }
    $numLength = count($numArr);
    for ($i = 0; $i < intval($numLength / 2); $i++) {
        if ($numArr[$i] !== $numArr[$numLength - 1 - $i]) {
            return false;
        }
    }

    return true;
}

/**
 * 不将整数转为字符串
 * @param Integer $x
 * @return Boolean
 */
function isPalindrome2($x)
{
    if ($x < 0) return false;

    $length = 1;
    while ($x >= pow(10, $length)) {
        $length++;
    }
    for ($i = 0; $i < intval($length / 2); $i++) {
        $left = intval($x / pow(10, $length - 1 - $i)) % pow(10, 1 + $i);
        $left = $left % 10;
        $right = intval($x % pow(10, 1 + $i) / pow(10, $i));
        if ($left !== $right) {
            return false;
        }
    }

    return true;
}

/* 测试代码 */

$testList = [0, 10, 11, 121];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = isPalindrome($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);