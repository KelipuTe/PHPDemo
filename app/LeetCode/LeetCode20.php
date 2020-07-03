<?php
/* LeetCode20 有效的括号 */

/**
 * @param String $s
 * @return Boolean
 */
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
        } else if ($s[$i] === ')' && $wait[$waitLen - 1] === '(') {
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
    if ($waitLen) return false;
    return true;
}

/* 测试代码 */

$testList = ['()', '()[]{}', '(]', '([)]', '{[]}', 'a', 'a(a)a'];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = isValid($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);