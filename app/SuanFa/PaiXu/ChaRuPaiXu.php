<?php

/*
 * 插入排序(Insertion PaiXu)
 * 时间复杂度=O(n^2)，空间复杂度=T(1)
 */

/**
 * @param $numList
 * @return array
 */
function insertionSort($numList)
{
    // 排序的次数
    $sortTimes = 0;
    // 排序的步骤
    $sortSteps = [];
    $sortSteps[] = json_encode($numList);

    $length = count($numList);
    for ($i = 0; $i < $length - 1; $i++) {
        $j = $i + 1;
        $temp = $numList[$j];
        while ($j > 0 && $temp < $numList[$j - 1]) {
            $sortTimes++;
            $numList[$j] = $numList[$j - 1];
            $numList[$j - 1] = $temp;
            $j--;
        }
        $numList[$j] = $temp;
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
echo json_encode(insertionSort($numList)) . PHP_EOL;
