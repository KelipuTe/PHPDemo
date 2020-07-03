<?php
/* LeetCode125 验证回文串 */

/**
 * @param String $s
 * @return Boolean
 */
function isPalindrome($s)
{
    if (strlen($s) === 0) return true;
    $s = preg_replace('/\W/', '', $s);
    $s = strtolower($s);
    $length = strlen($s);
    for ($i = 0; $i < $length / 2; $i++) {
        if ($s[$i] !== $s[$length - 1 - $i]) return false;
    }

    return true;
}

/* 测试代码 */

$testList = [
    'A man, a plan, a canal: Panama',
    'race a car',
    'abccba',
    'abcdcba',
    'ab1cdc1ba',
    'ab1cdc2ba',
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = isPalindrome($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);
