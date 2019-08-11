<?php

namespace App\AlgorithmDemo\DynamicProgramming\Handler;


/**
 * Class ClimbingStepsHandler
 * 爬台阶问题
 *
 * @package App\AlgorithmDemo\DynamicProgramming\Handler
 */
class ClimbingStepsHandler extends DynamicProgrammingHandlerAbstract
{
    /*
    |--------------------------------------------------------------------------
    | 问题描述
    |--------------------------------------------------------------------------
    |
    | 设：有 n 级台阶，每次上一级台阶或者两级台阶。
    | 问：有多少种方法走完 n 级台阶？
    |
    */

    /*
    |--------------------------------------------------------------------------
    | 数学建模
    |--------------------------------------------------------------------------
    |
    | 设：走到 n 级台阶的方式数为 f(n)。
    | 通过分析，可以发现这样一个规律：
    | n = 0 时，f(0) = 0;
    | n = 1 时，f(1) = 1;
    | n = 2 时，f(2) = 2;
    | n > 2 时，f(n) = f(n - 2) + f(n - 1);
    | 总结为：走到 n 级台阶的方式数为走到 n-1 级台阶的方式数与走到 n-2 级台阶的方式数之和。
    |
    */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 递归暴力求解
     *
     * @param int $steps [台阶数量]
     * @return int
     */
    public function recursionOnly(int $steps)
    {
        $this->handleSteps[] = '求解：steps=' . $steps;
        if ($steps <= 2) {
            return $steps;
        }
        $result = $this->recursionOnly($steps - 2) + $this->recursionOnly($steps - 1);

        return $result;
    }

    /**
     * 递归暴力求解的优化方案：记录结果
     *
     * @param int $steps
     * @return int
     */
    public function recursionByStorage(int $steps)
    {
        if (isset($this->handleStorage[$steps])) {
            return $this->handleResult[$steps]; // 如果发现已经计算过的结果则直接返回该结果
        }

        $this->handleSteps[] = '求解：steps=' . $steps;
        if ($steps <= 2) {
            $this->handleResult[$steps] = $steps; // 记录结果

            return $steps;
        }
        $result = $this->recursionByStorage($steps - 2) + $this->recursionByStorage($steps - 1);

        $this->handleResult[$steps] = $result; // 记录结果

        return $result;
    }

    /*
    |--------------------------------------------------------------------------
    | 动态规划
    |--------------------------------------------------------------------------
    |
    | 如果将台阶数和对应的结果保存为一个数组 dp[]，则 dp[n] 保存的数据就对应 f(n)。
    | 结合之前的结论 f(n) = f(n-2) + f(n-1)。我们就可以去掉递归结构，顺序计算。
    |
    */

    /**
     * 动态规划求解
     *
     * @param int $steps
     * @return int
     */
    public function dynamicProgramming(int $steps)
    {
        $dpResult = [];
        $dpResult[0] = 0;
        $dpResult[1] = 1;
        $dpResult[2] = 2;

        for ($i = 3; $i < $steps + 1; $i++) {
            $dpResult[$i] = $dpResult[$i - 2] + $dpResult[$i - 1];
        }

        return $dpResult[$steps];
    }
}
