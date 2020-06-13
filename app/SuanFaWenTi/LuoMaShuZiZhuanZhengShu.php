<?php
/* ##### 罗马数字转整数 ##### */

// 罗马数字包含以下七种字符: I， V， X， L，C，D 和 M。
// 字符=数值：I=1；V=5；X=10；L=50；C=100；D=500；M=1000
// 例如， 罗马数字 2 写做 II ，即为两个并列的 1。12 写做 XII ，即为 X + II 。 27 写做  XXVII, 即为 XX + V + II 。
//
// 通常情况下，罗马数字中小的数字在大的数字的右边。但也存在特例，
// 例如 4 不写做 IIII，而是 IV。数字 1 在数字 5 的左边，所表示的数等于大数 5 减小数 1 得到的数值 4 。
// 同样地，数字 9 表示为 IX。这个特殊的规则只适用于以下六种情况：
// I 可以放在 V (5) 和 X (10) 的左边，来表示 4 和 9。
// X 可以放在 L (50) 和 C (100) 的左边，来表示 40 和 90。
// C 可以放在 D (500) 和 M (1000) 的左边，来表示 400 和 900。
//
// 给定一个罗马数字，将其转换成整数。输入确保在 1 到 3999 的范围内。
//
// 示例 1:
// 输入: "III"
// 输出: 3
//
// 示例 2:
// 输入: "IV"
// 输出: 4

/* ##### 问题分析 ##### */

// 通常情况下直接累加所有的数字即可。
// 对于特例，则可以通过判断左右两个字符的大小来识别。
// 当左边的字符比右边的字符小时，减去左边的字符即可。
// XXIII=10+10+1+1+1
// XXIV=10+10-1+5
// XXV=10+10+5
// XXVI=10+10+5+1

/* ##### 代码 ##### */

function romanToInt($s)
{
    $romanMap = ['I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 'C' => 100, 'D' => 500, 'M' => 1000];
    $sArr = str_split($s);
    $n = 0;
    for ($i = 0; $i < count($sArr) - 1; $i++) {
        if ($romanMap[$sArr[$i]] >= $romanMap[$sArr[$i + 1]]) {
            $n += $romanMap[$sArr[$i]];
        } else {
            $n -= $romanMap[$sArr[$i]];
        }
    }
    $n += $romanMap[$sArr[count($sArr) - 1]];

    return $n;
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$testList = ['I', 'IV', 'V', 'VI', 'XL', 'XLI', 'XXIV', 'XXV', 'XXVI'];
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = romanToInt($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => round(($timeStop - $timeStart) / count($testList), 2),
    'result'    => $resultList
];
echo json_encode($echo);