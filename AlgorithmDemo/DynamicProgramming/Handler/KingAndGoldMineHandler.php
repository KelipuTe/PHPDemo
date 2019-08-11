<?php

namespace App\AlgorithmDemo\DynamicProgramming\Handler;


/**
 * Class KingAndGoldMineHandler
 * 国王的金矿问题
 *
 * @package App\AlgorithmDemo\DynamicProgramming\Handler
 */
class KingAndGoldMineHandler extends DynamicProgrammingHandlerAbstract
{
    /*
    |--------------------------------------------------------------------------
    | 问题描述
    |--------------------------------------------------------------------------
    |
    | 有一个国家发现了 5 座金矿，每座金矿的黄金储量不同，需要参与挖掘的工人数也不同。
    | 参与挖矿工人的总数是 10 人。每座金矿要么全挖，要么不挖，不能派出一半人挖取一半金矿。
    | 设：400金/5人 500金/5人, 200金/3人, 300金/4人, 350金/3人。
    | 问：要想得到尽可能多的黄金，应该选择挖取哪几座金矿？
    |
    */

    /*
    |--------------------------------------------------------------------------
    | 数学建模
    |--------------------------------------------------------------------------
    |
    | 第一步：使用排列组合，找出所有可能的情况。
    | 第二步：筛除工人总数超过 10 人的组合。
    | 第三步：计算剩下的各个组合的黄金总数，比较并得出最大值。
    |
    */

    public function __construct()
    {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | 动态规划
    |--------------------------------------------------------------------------
    |
    | 分析第五个金矿的最优解的情况。
    | 第一种情况：挖最后一个矿 ===>
    |   前四个金矿，(10-第五个金矿的工人数)个工人的最优解 + 第五个金矿
    | 第二种情况：不挖最后一个矿 ===>
    |   前四个金矿，10 个工人的最优解
    |
    */

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
