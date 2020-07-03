<?php
/* 最长公共前缀 */

/**
 * @param String[] $strs
 * @return String
 */
function longestCommonPrefix($strs)
{
    if (empty($strs)) return '';
    if (!isset($strs[1])) return $strs[0];

    $resultStr = '';
    $i = 0;
    $doContinue = true;
    while ($doContinue) {
        if (!isset($strs[0][$i])) break;
        $char = $strs[0][$i];
        foreach ($strs as $item) {
            if (!isset($item[$i]) || $char !== $item[$i]) {
                $doContinue = false;
                break;
            }
        }
        if ($doContinue) $resultStr .= $strs[0][$i];
        $i++;
    }

    return $resultStr;
}

/* 测试代码 */

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

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = longestCommonPrefix($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);