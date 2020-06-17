<?php
/* ##### 外观数列 ##### */

// 「外观数列」是一个整数序列，从数字 1 开始，序列中的每一项都是对前一项的描述。前五项如下：
//
// 1.     1
// 2.     11
// 3.     21
// 4.     1211
// 5.     111221
//
// 1 被读作  "one 1"  ("一个一") , 即 11。
// 11 被读作 "two 1s" ("两个一"）, 即 21。
// 21 被读作 "one 2",  "one 1" （"一个二" ,  "一个一") , 即 1211。
//
// 给定一个正整数 n（1 ≤ n ≤ 30），输出外观数列的第 n 项。
// 注意：整数序列中的每一项将表示为一个字符串。
//
// 示例 1:
// 输入: 1
// 输出: "1"
// 解释：这是一个基本样例。
//
// 示例 2:
// 输入: 4
// 输出: "1211"
// 解释：当 n = 3 时，序列是 "21"，其中我们有 "2" 和 "1" 两组，"2" 可以读作 "12"，也就是出现频次 = 1
//      而 值 = 2；类似 "1" 可以读作 "11"。所以答案是 "12" 和 "11" 组合在一起，也就是 "1211"。

/* ##### 问题分析 ##### */

// 题目的意思就是，计算一个数字字符转里面连续的数字有几个，然后输出成一个新的数字字符串。

/* ##### 代码 ##### */

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

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$resultList = countAndSay(5);
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => round($timeStop - $timeStart, 2),
    'result'    => $resultList
];
echo json_encode($echo);