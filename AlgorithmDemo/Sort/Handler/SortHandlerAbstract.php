<?php

namespace App\AlgorithmDemo\Sort\Handler;


abstract class SortHandlerAbstract
{
    protected $sortArray; // 排序数组

    protected $sortTimes; // 排序次数

    protected $sortSteps; // 排序步骤

    public function __construct(array $arrayData)
    {
        $this->sortArray = $arrayData;
        $this->sortTimes = 0;
        $this->sortSteps = [];
        $this->sortSteps[] = json_encode($this->sortArray);
    }

    abstract public function sort();
}
