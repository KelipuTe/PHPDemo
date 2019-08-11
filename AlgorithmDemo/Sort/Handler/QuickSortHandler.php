<?php

namespace App\AlgorithmDemo\Sort\Handler;


/**
 * Class QuickSortHandler
 * 快速排序(Quick Sort) 平均时间复杂度=O(nlog₂n) 空间复杂度=T(1)
 * 在最糟情况下(即待排序数组是有序数组时)，最糟时间复杂度=O(n²)
 *
 * @package App\AlgorithmDemo\Sort\Handler
 */
class QuickSortHandler extends SortHandlerAbstract
{
    public function sort()
    {
        $startIndex = 0;
        $endIndex = count($this->sortArray) - 1;
        $this->iSort($this->sortArray, $startIndex, $endIndex);

        return [
            'sortArray' => $this->sortArray,
            'sortTimes' => $this->sortTimes,
            'sortSteps' => $this->sortSteps,
        ];
    }

    private function iSort(array &$sortArray, int $startIndex, int $endIndex)
    {
        if ($startIndex >= $endIndex) {
            return $sortArray;
        }

        $i = $startIndex;
        $j = $endIndex;
        $middleNumber = $sortArray[$startIndex]; // 设定第一个元素作为标准
        for (; $j > $i; $j--) {
            $this->sortTimes++;
            if ($sortArray[$j] < $middleNumber) {
                $temp = $sortArray[$i];
                $sortArray[$i] = $sortArray[$j];
                $sortArray[$j] = $temp;
                $this->sortSteps[] = json_encode($this->sortArray);
                for ($i++; $i < $j; $i++) {
                    $this->sortTimes++;
                    if ($sortArray[$i] > $middleNumber) {
                        $temp = $sortArray[$j];
                        $sortArray[$j] = $sortArray[$i];
                        $sortArray[$i] = $temp;
                        $this->sortSteps[] = json_encode($this->sortArray);
                        break;
                    }
                }
            }
        }
        $this->iSort($sortArray, $startIndex, $i);
        $this->iSort($sortArray, $i + 1, $endIndex);
        return $sortArray;
    }
}
