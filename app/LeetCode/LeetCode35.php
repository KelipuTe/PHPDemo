<?php
/* LeetCode35 搜索插入位置 */

/**
 * @param Integer[] $nums
 * @param Integer $target
 * @return Integer
 */
function searchInsert($nums, $target)
{
    $length = count($nums);
    $left = 0;
    $right = $length - 1;
    while ($left <= $right) {
        $middle = intval(($left + $right) / 2);
        if ($target < $nums[$middle]) {
            if (!isset($nums[$middle - 1])) return 0;
            if ($target > $nums[$middle - 1]) return $middle;
            $right = $middle - 1;
        } else if ($target > $nums[$middle]) {
            if (!isset($nums[$middle + 1])) return $length;
            if ($target < $nums[$middle + 1]) return $middle + 1;
            $left = $middle + 1;
        } else {
            return $middle;
        }
    }

    return 0;
}

/* 测试代码 */

$testList = [
    ['nums' => [1, 3, 5, 6], 'target' => 5],
    ['nums' => [1, 3, 5, 6], 'target' => 2],
    ['nums' => [1, 3, 5, 6], 'target' => 7],
    ['nums' => [1, 3, 5, 6], 'target' => 0],
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = [
        'index' => searchInsert($item['nums'], $item['target']),
    ];
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);
