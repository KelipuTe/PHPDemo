<?php
/* LeetCode38 外观数列 */

/**
 * @param Integer $n
 * @return String
 */
function countAndSay($n)
{
    $numStrList = [];
    $numStrList[0] = '1';
    $numStrList[1] = '11';
    for ($i = 2; $i < $n; $i++) {
        $oleNumStr = $numStrList[$i - 1];
        $newNumStr = '';
        $num = $oleNumStr[0];
        $count = 1;
        for ($j = 1; $j < strlen($oleNumStr); $j++) {
            if ($num === $oleNumStr[$j]) {
                $count++;
            } else {
                $newNumStr .= $count . $num;
                $num = $oleNumStr[$j];
                $count = 1;
            }
        }
        $newNumStr .= $count . $num;
        $numStrList[$i] = $newNumStr;
    }

    return $numStrList[$n - 1];
}

/* 测试代码 */

$testList = [5];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = countAndSay($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);