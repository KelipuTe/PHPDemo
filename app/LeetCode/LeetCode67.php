<?php
/* LeetCode67 二进制求和 */

/**
 * @param String $a
 * @param String $b
 * @return String
 */
function addBinary($a, $b)
{
    $a = str_split($a);
    $b = str_split($b);
    $lengthA = count($a);
    $lengthB = count($b);
    if ($lengthA < $lengthB) {
        $long = $b;
        $lengthL = $lengthB;
        $short = $a;
        $lengthS = $lengthA;
    } else {
        $long = $a;
        $lengthL = $lengthA;
        $short = $b;
        $lengthS = $lengthB;
    }
    for ($i = $lengthL - 1, $j = $lengthS - 1; $i > 0; $i--, $j--) {
        if ($j > -1) {
            $long[$i] = intval($long[$i]) + intval($short[$j]);
        }
        if (intval($long[$i]) === 2) {
            $long[$i] = 0;
            $long[$i - 1] = intval($long[$i - 1]) + 1;
        } else if (intval($long[$i]) === 3) {
            $long[$i] = 1;
            $long[$i - 1] = intval($long[$i - 1]) + 1;
        }
    }
    if ($lengthL === $lengthS) {
        $long[0] = intval($long[0]) + intval($short[0]);
    }
    if ($long[0] === 2) {
        $long[0] = 0;
        array_unshift($long, 1);
    }
    if ($long[0] === 3) {
        $long[0] = 1;
        array_unshift($long, 1);
    }

    return implode($long);
}

/* 测试代码 */

$testList = [
    ['a' => '11', 'b' => '1'],
    ['a' => '1', 'b' => '10'],
    ['a' => '10', 'b' => '110'],
    ['a' => '1011', 'b' => '110'],
    ['a' => '1010', 'b' => '1011']
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = addBinary($item['a'], $item['b']);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);