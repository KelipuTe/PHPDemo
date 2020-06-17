<?php
/* ##### 买卖股票的最佳时机 II ##### */

// 给定一个数组，它的第 i 个元素是一支给定股票第 i 天的价格。
// 设计一个算法来计算你所能获取的最大利润。你可以尽可能地完成更多的交易（多次买卖一支股票）。
// 注意：你不能同时参与多笔交易（你必须在再次购买前出售掉之前的股票）。
//
// 示例 1:
// 输入: [7,1,5,3,6,4]
// 输出: 7
// 解释: 在第 2 天（股票价格 = 1）的时候买入，在第 3 天（股票价格 = 5）的时候卖出, 这笔交易所能获得利润 = 5-1 = 4 。
//      随后，在第 4 天（股票价格 = 3）的时候买入，在第 5 天（股票价格 = 6）的时候卖出, 这笔交易所能获得利润 = 6-3 = 3 。
//
// 示例 2:
// 输入: [1,2,3,4,5]
// 输出: 4
// 解释: 在第 1 天（股票价格 = 1）的时候买入，在第 5 天 （股票价格 = 5）的时候卖出, 这笔交易所能获得利润 = 5-1 = 4 。
//      注意你不能在第 1 天和第 2 天接连购买股票，之后再将它们卖出。
//      因为这样属于同时参与了多笔交易，你必须在再次购买前出售掉之前的股票。
//
// 示例 3:
// 输入: [7,6,4,3,1]
// 输出: 0
// 解释: 在这种情况下, 没有交易完成, 所以最大利润为 0。
//
// 提示：
//     1 <= prices.length <= 3 * 10 ^ 4
//     0 <= prices[i] <= 10 ^ 4

/* ##### 问题分析 ##### */

// 画个价格折线图，更有利于理解。
// 通过比较前后两个价格找出价格曲线的拐点，累计计算所有的价格上升的部分。
// 每一次的峰和谷的值是不一样的，所以每次遇到峰时需要重置最小买入价格为当前位置的价格，然后寻找这个峰之后的谷。
// 注意，价格一直上升，和价格一直下降的情况。

/* ##### 代码 ##### */

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
        if ($prices[$i] < $minPrice) {
            $minPrice = $prices[$i];
        }
        $lastPrice = $prices[$i];
    }
    if ($priceType) {
        $totalProfit += $lastPrice - $minPrice;
    }
    return $totalProfit;
}

/* ##### 测试 ##### */

$timeStart = intval(microtime(true) * 1000);
$testList = [
    [7, 1, 5, 3, 6, 4],
    [1, 2, 3, 4, 5],
    [7, 6, 4, 3, 1],
    [1, 2, 3, 7, 5, 1, 5],
];
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = maxProfit($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => round(($timeStop - $timeStart) / count($testList), 2),
    'result' => $resultList
];
echo json_encode($echo);
