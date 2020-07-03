<?php
/* LeetCode1 两数之和 */

/**
 * @param Integer[] $nums
 * @param Integer $target
 * @return Integer[]
 */
function twoSum($nums, $target)
{
    $numberMap = [];
    // 遍历第一遍构造 map
    foreach ($nums as $index => $value) {
        $numberMap[(string)$value] = $index;
    }
    // 遍历第二遍找答案
    foreach ($nums as $index => $value) {
        $otherValue = $target - $value;
        $otherKey = (string)$otherValue;
        if (isset($numberMap[$otherKey]) && $index !== $numberMap[$otherKey]) {
            return [$index, $numberMap[$otherKey]];
        }
    }
    return [];
}

/* 测试代码 */

$testList = [
    ['nums' => [3, 2, 4], 'target' => 6],
    ['nums' => [5, 3, 3, 2], 'target' => 6],
    ['nums' => [2, 7, 11, 15], 'target' => 9],
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = twoSum($item['nums'], $item['target']);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);
