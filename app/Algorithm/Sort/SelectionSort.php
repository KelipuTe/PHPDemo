<?php

namespace App\Algorithm\Sort;


require_once 'SortAbstract.php';

class SelectionSort extends SortAbstract
{
    // 选择排序(Selection Sort)，时间复杂度=O(n^2)，空间复杂度=T(1)

    public function sort()
    {
        $length = count($this->sortArray);
        for ($i = 0; $i < $length; $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < $length; $j++) {
                $this->sortTimes++;
                if ($this->sortArray[$j] < $this->sortArray[$minIndex]) {
                    $minIndex = $j;
                }
            }
            $temp = $this->sortArray[$i];
            $this->sortArray[$i] = $this->sortArray[$minIndex];
            $this->sortArray[$minIndex] = $temp;
            $this->sortSteps[] = json_encode($this->sortArray);
        }

        return [
            'sortArray' => $this->sortArray,
            'sortTimes' => $this->sortTimes,
            'sortSteps' => $this->sortSteps,
        ];
    }
}
