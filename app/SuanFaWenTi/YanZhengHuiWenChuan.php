<?php
/* ##### 验证回文串 ##### */

// 给定一个字符串，验证它是否是回文串，只考虑字母和数字字符，可以忽略字母的大小写。
// 说明：本题中，我们将空字符串定义为有效的回文串。
//
// 示例 1:
// 输入: "A man, a plan, a canal: Panama"
// 输出: true
//
// 示例 2:
// 输入: "race a car"
// 输出: false

/* ##### 问题分析 ##### */

// 题目的要求是要去掉空格和特殊符号的，同时还要忽略大小写。

/* ##### 代码 ##### */

/**
 * @param String $s
 * @return Boolean
 */
function isPalindrome($s)
{
    if (strlen($s) === 0) {
        return true;
    }
    $s = preg_replace('/\W/', '', $s);
    $s = strtolower($s);
    $length = strlen($s);
    for ($i = 0; $i < $length / 2; $i++) {
        if ($s[$i] !== $s[$length - 1 - $i]) {
            return false;
        }
    }
    return true;
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$testList = [
    'A man, a plan, a canal: Panama',
    'race a car',
    'abccba',
    'abcdcba',
    'ab1cdc1ba',
    'ab1cdc2ba',
];
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = isPalindrome($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => round(($timeStop - $timeStart) / count($testList), 2),
    'result' => $resultList
];
echo json_encode($echo);
