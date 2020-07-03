<?php
/* LeetCode122 买卖股票的最佳时机 II */

/**
 * @param Integer[] $prices
 * @return Integer
 */
function maxProfit($prices)
{
    $totalProfit = 0;
    $minPrice = $prices[0];
    $lastPrice = $prices[0];
    $priceType = true;
    for ($i = 1; $i < count($prices); $i++) {
        if (!$priceType && $lastPrice < $prices[$i]) {
            $priceType = true;
        } else if ($priceType && $lastPrice > $prices[$i]) {
            $priceType = false;
            $totalProfit += $lastPrice - $minPrice;
            $minPrice = $prices[$i];
        }
        if ($prices[$i] < $minPrice) $minPrice = $prices[$i];

        $lastPrice = $prices[$i];
    }
    if ($priceType) $totalProfit += $lastPrice - $minPrice;

    return $totalProfit;
}

/* 测试代码 */

$testList = [
    [1, 2, 3, 4, 5],
    [7, 6, 4, 3, 1],
    [7, 1, 5, 3, 6, 4],
    [1, 2, 3, 7, 5, 1, 5],
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
