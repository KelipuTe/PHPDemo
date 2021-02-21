<?php
/*#####leetcode14-两数之和#####*/

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

    $sResStr = '';
    $i = 0;
    $bDoContinue = true;
    while ($bDoContinue) {
        if (!isset($strs[0][$i])) {
            break;
        }
        $tc = $strs[0][$i];
        foreach ($strs as $tItem) {
            if (!isset($tItem[$i]) || $tc !== $tItem[$i]) {
                $bDoContinue = false;
                break;
            }
        }
        if ($bDoContinue) {
            $sResStr .= $tc;
        }
        $i++;
    }

    return $sResStr;
}

$arrTest = [
    ['flower', 'flow', 'flight'],
    ['aasdfcsv', 'drfgewsedfr', 'awdadaagfaedf', 'awdadaagfaedf'],
    ['floasdafwer']
];
foreach ($arrTest as $tItem) {
    echo longestCommonPrefix($tItem) . PHP_EOL;
}