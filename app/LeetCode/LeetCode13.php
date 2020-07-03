<?php
/* LeetCode13 罗马数字转整数 */

/**
 * @param String $s
 * @return Integer
 */
function romanToInt($s)
{
    $romanMap = ['I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 'C' => 100, 'D' => 500, 'M' => 1000];
    $sArr = str_split($s);
    $n = 0;
    for ($i = 0; $i < count($sArr) - 1; $i++) {
        if ($romanMap[$sArr[$i]] >= $romanMap[$sArr[$i + 1]]) {
            $n += $romanMap[$sArr[$i]];
        } else {
            $n -= $romanMap[$sArr[$i]];
        }
    }
    $n += $romanMap[$sArr[count($sArr) - 1]];

    return $n;
}

/* 测试代码 */

$testList = ['I', 'IV', 'V', 'VI', 'XL', 'XLI', 'XXIV', 'XXV', 'XXVI'];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);

foreach ($testList as $item) {
    $resultList[] = romanToInt($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => $timeStop - $timeStart,
    'result'    => $resultList
];
echo json_encode($echo);