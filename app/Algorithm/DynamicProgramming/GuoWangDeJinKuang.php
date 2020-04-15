<?php

namespace App\Algorithm\DynamicProgramming;


require_once 'DynamicProgrammingAbstract.php';

class GuoWangDeJinKuang extends DynamicProgrammingAbstract
{
    // 国王的金矿问题

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 动态规划求解
     *
     * @param array $goldMine     [金矿工人关系数组]
     * @param int   $workerNumber [工人总数]
     * @return int
     */
    public function dynamicProgramming(array $goldMine, int $workerNumber)
    {
        $dpResult = [];
        $goldArray = [];
        $workerArray = [];
        $goldMineCount = 0;
        foreach ($goldMine as $item) {
            $item = explode('-', $item);
            $goldArray[] = (int)$item[0];
            $workerArray[] = (int)$item[1];
            $goldMineCount++;
        }
        // 初始化矩阵第一行
        for ($j = 0; $j <= $workerNumber; $j++) {
            if ($j < $workerArray[0]) {
                $dpResult[0][$j] = 0;
            } else {
                $dpResult[0][$j] = $goldArray[0];
            }
        }
        // 依次计算剩余部分的结果，外层循环是金矿，内层循环是工人
        for ($i = 1; $i < $goldMineCount; $i++) {
            for ($j = 0; $j <= $workerNumber; $j++) {
                if ($j < $workerArray[$i]) {
                    $dpResult[$i][$j] = $dpResult[$i - 1][$j];
                } else {
                    $newResult = $dpResult[$i - 1][$j - $workerArray[$i]] + $goldArray[$i];
                    $dpResult[$i][$j] = max($dpResult[$i - 1][$j], $newResult);
                }
            }
        }

        return $dpResult[$goldMineCount - 1][$workerNumber];
    }
}
