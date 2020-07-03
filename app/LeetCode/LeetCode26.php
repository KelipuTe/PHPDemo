<?php
/* LeetCode26 删除排序数组中的重复项 */

/**
 * @param Integer[] $nums
 * @return Integer
 */
function removeDuplicates(&$nums)
{
    $i = 0;
    for ($j = 1; $j < count($nums); $j++) {
        if ($nums[$i] !== $nums[$j]) {
            $i++;
            $nums[$i] = $nums[$j];
        } else {
            continue;
        }
    }

    return $i + 1;
}

/* 测试代码 */

$testList = [
    [1, 1, 2],
    [0, 0, 1, 1, 1, 2, 2, 3, 3, 4]
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = [
        'num'  => removeDuplicates($item),
        'list' => $item
    ];
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => $timeStop - $timeStart,
    'result'    => $resultList
];
echo json_encode($echo);
