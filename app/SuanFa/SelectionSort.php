<?php

/*
 * 选择排序(Selection PaiXu)
 * 时间复杂度=O(n^2)，空间复杂度=T(1)
 */

/**
 * @param $numList
 * @return array
 */
function selectionSort($numList)
{
    // 排序的次数
    $sortTimes = 0;
    // 排序的步骤
    $sortSteps = [];
    $sortSteps[] = json_encode($numList);

    $length = count($numList);
    for ($i = 0; $i < $length; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $length; $j++) {
            $sortTimes++;
            if ($numList[$j] < $numList[$minIndex]) {
                $minIndex = $j;
            }
        }

        $temp = $numList[$i];
        $numList[$i] = $numList[$minIndex];
        $numList[$minIndex] = $temp;

        $sortSteps[] = json_encode($numList);
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
echo json_encode(selectionSort($numList)) . PHP_EOL;
