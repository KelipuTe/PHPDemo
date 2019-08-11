<?php

namespace App\AlgorithmDemo\Sort\Handler;

/**
 * Class InsertionSortHandler
 * 插入排序(Insertion Sort) 时间复杂度=O(n²) 空间复杂度=T(1)
 *
 * @package App\AlgorithmDemo\Sort\Handler
 */
class InsertionSortHandler extends SortHandlerAbstract
{
    public function sort()
    {
        $length = count($this->sortArray);
        for ($i = 0; $i < $length - 1; $i++) {
            $j = $i + 1;
            $temp = $this->sortArray[$j];
            while ($j > 0 && $temp < $this->sortArray[$j - 1]) {
                $this->sortTimes++;
                $this->sortArray[$j] = $this->sortArray[$j - 1];
                $this->sortArray[$j - 1] = $temp;
                $this->sortSteps[] = json_encode($this->sortArray);
                $j--;
            }
            $this->sortArray[$j] = $temp;
            $this->sortSteps[] = json_encode($this->sortArray);
        }

        return [
            'sortArray' => $this->sortArray,
            'sortTimes' => $this->sortTimes,
            'sortSteps' => $this->sortSteps,
        ];
    }
}
