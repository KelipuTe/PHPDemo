<?php
/* LeetCode27 移除元素 */

/**
 * @param Integer[] $nums
 * @param Integer $val
 * @return Integer
 */
function removeElement(&$nums, $val)
{
    foreach ($nums as $index => $item) {
        if ($val === $item) unset($nums[$index]);
    }

    return count($nums);
}

/* ##### 测试 ##### */

$testList = [
    ['list' => [3, 2, 2, 3], 'value' => 3]
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = [
        'num' => removeElement($item['list'], $item['value']),
        'list' => $item['list']
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