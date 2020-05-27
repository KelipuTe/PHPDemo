<?php

/*
 * 冒泡排序(Bubble PaiXu)
 * 时间复杂度=O(n^2)，空间复杂度=T(1)
 */

/**
 * 这是稍加改进过的冒泡排序，跳过部分无意义的比较
 * @param $numList
 * @return array
 */
function bubbleSort($numList)
{
    // 排序的次数
    $sortTimes = 0;
    // 排序的步骤
    $sortSteps = [];
    $sortSteps[]= json_encode($numList);

    $listLength = count($numList);
    for ($i = 0; $i < $listLength - 1; $i++) {
        // 记录数组中是否有元素被交换
        $isSorted = false;
        $lastSortIndex = $listLength - 1 - $i;
        // 记录最后一个被交换的元素的位置
        $lastExchangeIndex = $lastSortIndex;
        for ($j = 0; $j < $lastSortIndex; $j++) {
            $sortTimes++;
            if ($numList[$j] > $numList[$j + 1]) {
                $isSorted = true;

                $temp = $numList[$j + 1];
                $numList[$j + 1] = $numList[$j];
                $numList[$j] = $temp;

                $lastExchangeIndex = $j;

                $sortSteps[] = json_encode($numList);
            }
        }
        // 下一轮内层循环，只比较到最后一个被交换的元素的位置
        $lastSortIndex = $lastExchangeIndex;
        if (!$isSorted) {
            // 如果数组中没有元素被交换，则数组已经有序
            break;
        }
    }

    return [
        'sortArray' => $numList,
        'sortTimes' => $sortTimes,
        'sortSteps' => $sortSteps,
    ];
}

/* 测试代码 */

$listLength = 10;
$numList = [];
for ($i = 0; $i < $listLength; $i++) {
    $numList[] = rand(1, 50);
}
echo json_encode(bubbleSort($numList)) . PHP_EOL;
