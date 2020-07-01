<?php
/* ##### 二进制求和 ##### */

// 给你两个二进制字符串，返回它们的和（用二进制表示）。
// 输入为 非空 字符串且只包含数字 1 和 0。
//
// 示例 1:
// 输入: a = "11", b = "1"
// 输出: "100"
//
// 示例 2:
// 输入: a = "1010", b = "1011"
// 输出: "10101"

/* ##### 问题分析 ##### */

// 把字符串换转换成数组，然后从最后一位开始算。只有求和有四种结果，分别是 0,1,2,3。
// 0 和 1 是不需要考虑进位的，2 对应 进 1 余 0 ，3 对应 进 1 余 1。
// 进位的结果直接加在前面一个位置的结果上，重复上述求和操作。

/* ##### 代码 ##### */

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

/* ##### 测试 ##### */

$testList = [
    ['a' => '11', 'b' => '1'],
    ['a' => '1010', 'b' => '1011'],
    ['a' => '11', 'b' => '101']
];

$timeStart = intval(microtime(true) * 1000);
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = addBinary($item['a'], $item['b']);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => round(($timeStop - $timeStart) / count($testList), 2),
    'result' => $resultList
];
echo json_encode($echo);