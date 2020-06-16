<?php
/* ##### 杨辉三角 ##### */

// 给定一个非负整数 numRows，生成杨辉三角的前 numRows 行。
// 在杨辉三角中，每个数是它左上方和右上方的数的和。
//
// 示例:
// 输入: 5
// 输出:
// [
//     [1],
//     [1,1],
//     [1,2,1],
//     [1,3,3,1],
//     [1,4,6,4,1]
// ]

/* ##### 代码 ##### */

/**
 * @param Integer $numRows
 * @return Integer[][]
 */
function generate($numRows)
{
    if ($numRows === 0) {
        return [];
    }
    $yh = [];
    $yh[0][0] = 1;
    for ($i = 1; $i < $numRows; $i++) {
        $yh[$i][0] = 1;
        for ($j = 1; $j < $i; $j++) {
            $yh[$i][$j] = $yh[$i - 1][$j - 1] + $yh[$i - 1][$j];
        }
        $yh[$i][$j] = 1;
    }
    return $yh;
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$resultList = generate(5);
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => round($timeStop - $timeStart, 2),
    'result' => $resultList
];
echo json_encode($echo);
