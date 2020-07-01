<?php
/* ##### 最长公共前缀 ##### */

// 编写一个函数来查找字符串数组中的最长公共前缀。
// 如果不存在公共前缀，返回空字符串 ""。
//
// 示例 1:
// 输入: ["flower","flow","flight"]
// 输出: "fl"
//
// 示例 2:
// 输入: ["dog","racecar","car"]
// 输出: ""
// 解释: 输入不存在公共前缀。

/* ##### 问题分析 ##### */

// 逐位比较每个字符串的同位的字符是不是一样，如果不一样就结束比较。

/* ##### 代码 ##### */

/**
 * @param String[] $strs
 * @return String
 */
function longestCommonPrefix($strs)
{
    if (empty($strs)) {
        return '';
    }
    if (!isset($strs[1])) {
        return $strs[0];
    }
    $resultStr = '';
    $i = 0;
    $doContinue = true;
    while ($doContinue) {
        if (!isset($strs[0][$i])) {
            break;
        }
        $char = $strs[0][$i];
        foreach ($strs as $item) {
            if (!isset($item[$i]) || $char !== $item[$i]) {
                $doContinue = false;
                break;
            }
        }
        if ($doContinue) {
            $resultStr .= $strs[0][$i];
        }
        $i++;
    }
    return $resultStr;
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$testList = [
    [],
    ['floasdafwer'],
    ['floasdafwer', 'flaadfow', 'fladfadsfight', 'flaadaszfow', 'flaadaseddfow'],
    ['apwsedple', 'apadsfasdsd', 'apfvasedfarfgvarfinh'],
    ['aasdfcsv', 'drfgewsedfr', 'awdadaagfaedf', 'awdadaagfaedf'],
    ['aaawdawdawd', 'aaawdawdawd', 'aaawdawdawd', 'aaawdawdawd', 'aaawdawdawd'],
    ['aiasedfrvbhiuhergbfiaerbgfhi', 'vaiedfkcbgkrdeufgbuia', 'aqiwdgbikehd'],
];
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = longestCommonPrefix($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => round(($timeStop - $timeStart) / count($testList), 2),
    'result'    => $resultList
];
echo json_encode($echo);