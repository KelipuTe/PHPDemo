<?php

namespace App\SuanFa\PaiXu;


abstract class PaiXuAbstract
{
    /**
     * @var array [待排序序列]
     */
    protected $beforeSortList;

    /**
     * @var array [排序结果序列]
     */
    protected $afterSortList;

    /**
     * @var int [排序次数]
     */
    protected $sortTimes;

    /**
     * @var array [排序步骤]
     */
    protected $sortSteps;

    /**
     * PaiXuAbstract constructor.
     * @param array $beforeSortList
     */
    public function __construct($beforeSortList = [])
    {
        $this->beforeSortList = $beforeSortList;
        $this->afterSortList = [];
        $this->sortTimes = 0;
        $this->sortSteps = [];
        if (is_array($beforeSortList) && count($beforeSortList) > 0) $this->doSort();
    }

    /**
     * 设置待排序序列
     * @param array $beforeSortList
     */
    public function setBeforeSortList($beforeSortList = [])
    {
        $this->beforeSortList = $beforeSortList;
        $this->afterSortList = [];
        $this->sortTimes = 0;
        $this->sortSteps = [];
        if (is_array($beforeSortList) && count($beforeSortList) > 0) $this->doSort();
    }

    /**
     * 获取排序结果序列和排序过程细节
     * @return array
     */
    public function getSortResult()
    {
        return [
            'before_sort_list' => $this->beforeSortList,
            'after_sort_list' => $this->afterSortList,
            'sort_times' => $this->sortTimes,
            'sort_steps' => $this->sortSteps,
        ];
    }

    /**
     * 排序算法
     */
    abstract protected function doSort();
}