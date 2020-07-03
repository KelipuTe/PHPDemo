<?php
/* LeetCode66 加一 ##### */

/**
 * @param Integer[] $digits
 * @return Integer[]
 */
function plusOne($digits)
{
    $length = count($digits);
    if ($digits[$length - 1] === 9) {
        if (!isset($digits[$length - 2])) return [1, 0];
        $digits[$length - 1] = 0;
        $digits[$length - 2]++;
        for ($i = $length - 2; $i > 0; $i--) {
            if ($digits[$i] === 10) {
                $digits[$i] = 0;
                $digits[$i - 1]++;
            }
        }
        if ($digits[0] === 10) {
            $digits[0] = 0;
            array_unshift($digits, 1);
        }
    } else {
        $digits[$length - 1]++;
    }

    return $digits;
}

/* 测试代码 */

$testList = [
    [0], [9],
    [1, 9], [9, 9],
    [1, 1, 9], [1, 9, 9],
    [9, 9, 9, 9],
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = plusOne($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);

