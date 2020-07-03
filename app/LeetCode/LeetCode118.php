<?php
/* LeetCode118 杨辉三角 */

/**
 * @param Integer $numRows
 * @return Integer[][]
 */
function generate($numRows)
{
    if ($numRows === 0) return [];

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

/* 测试代码 */

$testList = [5, 6];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = generate($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);
