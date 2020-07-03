<?php
/* LeetCode121 买卖股票的最佳时机 */

/**
 * @param Integer[] $prices
 * @return Integer
 */
function maxProfit($prices)
{
    $maxProfit = 0;
    $minPrice = $prices[0];
    for ($i = 1; $i < count($prices); $i++) {
        $profit = $prices[$i] - $minPrice;
        if ($profit > $maxProfit) $maxProfit = $profit;
        if ($prices[$i] < $minPrice) $minPrice = $prices[$i];
    }

    return $maxProfit;
}

/* 测试代码 */

$testList = [
    [7, 1, 5, 3, 6, 4],
    [7, 6, 4, 3, 1]
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = maxProfit($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);