<?php

namespace App\AlgorithmDemo\Sort\Handler;


/**
 * Class BubbleSortHandler
 * 冒泡排序(Bubble Sort) 时间复杂度=O(n²) 空间复杂度=T(1)
 * 这是稍加改进过的冒泡排序，跳过部分无意义的比较
 *
 * @package App\AlgorithmDemo\Sort\Handler
 */
class BubbleSortHandler extends SortHandlerAbstract
{
    public function sort()
    {
        $length = count($this->sortArray);
        for ($i = 0; $i < $length - 1; $i++) {
            $isSorted = true; // 记录数组中是否有元素被交换
            $lastSortIndex = $length - 1 - $i;
            $lastExchangeIndex = $lastSortIndex; // 记录最后一个被交换的元素的位置
            for ($j = 0; $j < $lastSortIndex; $j++) {
                $this->sortTimes++;
                if ($this->sortArray[$j] > $this->sortArray[$j + 1]) {
                    $isSorted = false;
                    $temp = $this->sortArray[$j + 1];
                    $this->sortArray[$j + 1] = $this->sortArray[$j];
                    $this->sortArray[$j] = $temp;
                    $lastExchangeIndex = $j;
                    $this->sortSteps[] = json_encode($this->sortArray);
                }
            }
            $lastSortIndex = $lastExchangeIndex; // 下一轮内层循环，只比较到最后一个被交换的元素的位置
            if ($isSorted) {
                break; // 如果数组中没有元素被交换，则数组已经有序
            }
        }

        return [
            'sortArray' => $this->sortArray,
            'sortTimes' => $this->sortTimes,
            'sortSteps' => $this->sortSteps,
        ];
    }
}
