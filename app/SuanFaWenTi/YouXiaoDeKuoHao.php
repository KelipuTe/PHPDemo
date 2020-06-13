<?php
/* ##### 有效的括号 ##### */

// 给定一个只包括 '('，')'，'{'，'}'，'['，']' 的字符串，判断字符串是否有效。
// 有效字符串需满足：
// 左括号必须用相同类型的右括号闭合。
// 左括号必须以正确的顺序闭合。
// 注意空字符串可被认为是有效字符串。
//
// 示例 1:
// 输入: "()"
// 输出: true
//
// 示例 2:
// 输入: "()[]{}"
// 输出: true
//
// 示例 3:
// 输入: "(]"
// 输出: false
//
// 示例 4:
// 输入: "([)]"
// 输出: false

/* ##### 代码 ##### */

function isValid($s)
{
    $wait = [];
    $waitLen = 0;
    for ($i = 0; $i < strlen($s); $i++) {
        if ($s[$i] === '(' || $s[$i] === '[' || $s[$i] === '{') {
            $wait[] = $s[$i];
            $waitLen++;
            continue;
        }
        if ($s[$i] !== ')' && $s[$i] !== ']' && $s[$i] !== '}') {
            continue;
        } elseif ($s[$i] === ')' && $wait[$waitLen - 1] === '(') {
            array_pop($wait);
            $waitLen--;
        } else if ($s[$i] === ']' && $wait[$waitLen - 1] === '[') {
            array_pop($wait);
            $waitLen--;
        } else if ($s[$i] === '}' && $wait[$waitLen - 1] === '{') {
            array_pop($wait);
            $waitLen--;
        } else {
            return false;
        }
    }
    if ($waitLen) {
        return false;
    }
    return true;
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$testList = ['()', '()[]{}', '(]', '([)]', '{[]}','a','a(a)a'];
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = isValid($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => round(($timeStop - $timeStart) / count($testList), 2),
    'result'    => $resultList
];
echo json_encode($echo);