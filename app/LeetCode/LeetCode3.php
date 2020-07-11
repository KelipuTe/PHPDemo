<?php
/* LeetCode3 无重复字符的最长子串 */

/**
 * @param String $s
 * @return Integer
 */
function lengthOfLongestSubstring($s)
{
    $len = strlen($s);
    if ($len === 0) return 0;
    if ($len === 1) return 1;

    // 右指针 $p，初始化为 -1 表示还没有移动
    $p = -1;
    $strLen = 0;
    // set 集合用于判断字符串是否重复
    $strSet = [];
    // 左指针 $i
    for ($i = 0; $i < $len; ++$i) {
        // 当左指针右移的时候要从 set 里移除前一个位置的字符
        if ($i !== 0) unset($strSet[$s[$i - 1]]);
        while ($p + 1 < $len && !isset($strSet[$s[$p + 1]])) {
            // 如果没有重复，指针就继续右移
            $strSet[$s[$p + 1]] = $s[$p + 1];
            ++$p;
        }
        $strLen = max($strLen, $p - $i + 1);
    }

    return $strLen;
}

/* 测试代码 */

$testList = ['abcabcbb', 'bbbbb', 'pwwkew'];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = lengthOfLongestSubstring($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);