<?php
/* LeetCode 718 最长重复子数组 */

/**
 * @param Integer[] $A
 * @param Integer[] $B
 * @return Integer
 */
function findLength($A, $B)
{
    $lenA = count($A);
    if ($lenA === 0) return 0;
    $lenB = count($B);
    if ($lenB === 0) return 0;

    $dp = [];
    $maxLen = 0;
    // 初始化第一行和第一列的结果
    for ($j = 0; $j < $lenB; ++$j) {
        $dp[0][$j] = $B[$j] === $A[0] ? 1 : 0;
        $maxLen = $dp[0][$j] > $maxLen ? $dp[0][$j] : $maxLen;
    }
    for ($i = 0; $i < $lenA; ++$i) {
        $dp[$i][0] = $A[$i] === $B[0] ? 1 : 0;
        $maxLen = $dp[$i][0] > $maxLen ? $dp[$i][0] : $maxLen;
    }
    // 通过状态转移方程计算结果
    for ($i = 1; $i < $lenA; ++$i) {
        for ($j = 1; $j < $lenB; ++$j) {
            $dp[$i][$j] = $A[$i] === $B[$j] ? $dp[$i - 1][$j - 1] + 1 : 0;
            $maxLen = $dp[$i][$j] > $maxLen ? $dp[$i][$j] : $maxLen;
        }
    }

    return $maxLen;
}

/* 测试代码 */

$testList = [
    ['A' => [], 'B' => []],
    ['A' => [], 'B' => [1, 2]],
    ['A' => [1, 2, 1, 2], 'B' => []],
    ['A' => [1, 2, 1, 2], 'B' => [1, 2]],
    ['A' => [1, 2, 3, 2, 1], 'B' => [3, 2, 1, 4, 7]],
    ['A' => [1, 2, 3, 3, 2, 1], 'B' => [3, 2, 7, 1, 4, 7]],
    ['A' => [1, 2, 3, 2, 1], 'B' => [3, 2, 1, 4, 7, 1, 2, 3, 2, 1]],
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = findLength($item['A'], $item['B']);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => ($timeStop - $timeStart),
    'resultList' => $resultList
];
echo json_encode($echo);