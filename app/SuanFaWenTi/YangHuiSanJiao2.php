<?php
/* ##### 杨辉三角 II ##### */

// 给定一个非负索引 k，其中 k ≤ 33，返回杨辉三角的第 k 行。
// 在杨辉三角中，每个数是它左上方和右上方的数的和。
//
// 示例:
// 输入: 3
// 输出: [1,3,3,1]
//
// 进阶：
// 你可以优化你的算法到 O(k) 空间复杂度吗？

/* ##### 代码 ##### */

/**
 * @param Integer $rowIndex
 * @return Integer[]
 */
function getRow($rowIndex)
{
    $rowIndex += 1;
    if ($rowIndex === 0) {
        return [];
    }
    $yh = [];
    $yh[0] = 1;
    for ($i = 1; $i < $rowIndex; $i++) {
        $yh[$i] = 1;
        for ($j = $i - 1; $j > 0; $j--) {
            $yh[$j] = $yh[$j] + $yh[$j - 1];
        }
    }
    return $yh;
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$resultList = getRow(5);
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => round($timeStop - $timeStart, 2),
    'result' => $resultList
];
echo json_encode($echo);