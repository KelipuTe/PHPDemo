<?php
/* LeetCode58 最后一个单词的长度 */

/**
 * @param String $s
 * @return Integer
 */
function lengthOfLastWord($s)
{
    $length = strlen($s);
    $start = false;
    $str = '';
    for ($i = $length - 1; $i > -1; $i--) {
        if (!$start && $s[$i] === ' ') {
            continue;
        } else {
            $start = true;
        }
        if ($start && $s[$i] !== ' ') {
            $str = $s[$i] . $str;
        } else {
            break;
        }
    }

    return strlen($str);
}

/* 测试代码 */

$testList = ['', ' ', ' aa bb ', 'array list', 'hello world'];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = lengthOfLastWord($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);