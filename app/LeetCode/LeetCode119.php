<?php
/* LeetCode119 杨辉三角 II */

/**
 * @param Integer $rowIndex
 * @return Integer[]
 */
function getRow($rowIndex)
{
    $rowIndex += 1;
    if ($rowIndex === 0) return [];

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

/* 测试代码 */

$testList = [5, 6];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = getRow($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);