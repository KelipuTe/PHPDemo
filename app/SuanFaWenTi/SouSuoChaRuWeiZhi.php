<?php
/* ##### 搜索插入位置 ##### */

// 给定一个排序数组和一个目标值，在数组中找到目标值，并返回其索引。
// 如果目标值不存在于数组中，返回它将会被按顺序插入的位置。
// 你可以假设数组中无重复元素。
//
// 示例 1:
// 输入: [1,3,5,6], 5
// 输出: 2
//
// 示例 2:
// 输入: [1,3,5,6], 2
// 输出: 1
//
// 示例 3:
// 输入: [1,3,5,6], 7
// 输出: 4
//
// 示例 4:
// 输入: [1,3,5,6], 0
// 输出: 0

/* ##### 代码 ##### */

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
            if (!isset($nums[$middle - 1])) {
                return 0;
            }
            if ($target > $nums[$middle - 1]) {
                return $middle;
            }
            $right = $middle - 1;
        } else if ($target > $nums[$middle]) {
            if (!isset($nums[$middle + 1])) {
                return $length;
            }
            if ($target < $nums[$middle + 1]) {
                return $middle + 1;
            }
            $left = $middle + 1;
        } else {
            return $middle;
        }
    }
    return 0;
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$testList = [
    ['nums' => [1, 3, 5, 6], 'target' => 5],
    ['nums' => [1, 3, 5, 6], 'target' => 2],
    ['nums' => [1, 3, 5, 6], 'target' => 7],
    ['nums' => [1, 3, 5, 6], 'target' => 0],
];
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = [
        'index' => searchInsert($item['nums'], $item['target']),
    ];
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => round(($timeStop - $timeStart) / count($testList), 2),
    'result'    => $resultList
];
echo json_encode($echo);
