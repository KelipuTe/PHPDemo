<?php

namespace App\AlgorithmDemo\DynamicProgramming\Handler;


/**
 * Class GiveChangeHandler
 * 找零钱问题
 *
 * @package App\AlgorithmDemo\DynamicProgramming\Handler
 */
class GiveChangeHandler extends DynamicProgrammingHandlerAbstract
{
    /*
    |--------------------------------------------------------------------------
    | 问题描述
    |--------------------------------------------------------------------------
    |
    | 设：现有 n 种不同面值的货币，每种货币可以使用任意张。
    | 问：给定一个数额的货币，一共可以有多少种组合方法
    |
    */

    /*
    |--------------------------------------------------------------------------
    | 数学建模
    |--------------------------------------------------------------------------
    |
    | 第一步：将货币面值由小到大排序。
    | 第二步：假设第一种面值的货币使用 0,1,2... 张。比较目标数额和当前数额的大小。
    |   如果目标数额大于当前数额，且大于第二种货币的面值。
    |   假设第二种面值的货币使用 0,1,2... 张。比较目标数额和当前数额的大小。
    |   依次重复上述步骤，直到所有的货币面额都被使用过。
    |
    */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 递归暴力求解
     *
     * @param array $penny [从小到大排好序的零钱数组]
     * @param int   $index [零钱数组的数组下标]
     * @param int   $aim   [目标数值]
     * @return int
     */
    public function recursionOnly(array $penny, int $index, int $aim)
    {
        $result = 0;
        if ($index === count($penny)) {
            $result = $aim === 0 ? 1 : 0;
        } else {
            for ($i = 0; $i * $penny[$index] <= $aim; $i++) {
                $result += $this->recursionOnly($penny, $index + 1, $aim - $i * $penny[$index]);
            }
        }

        $this->handleSteps[] = '求解：index=' . $index . ',aim=' . $aim . '=>' . $result;

        return $result;
    }

    /**
     * 递归暴力求解的优化方案：记录结果
     *
     * @param array $penny [从小到大排好序的零钱数组]
     * @param int   $index [零钱数组的数组下标]
     * @param int   $aim   [目标数值]
     * @return int
     */
    public function recursionByStorage(array $penny, int $index, int $aim)
    {
        $key = $index . '_' . $aim;

        if (isset($this->handleResult[$key])) {
            return $this->handleResult[$key]; // 计算过的直接取值
        }

        $result = 0;
        if ($index === count($penny)) {
            $result = $aim === 0 ? 1 : 0;
        } else {
            for ($i = 0; $i * $penny[$index] <= $aim; $i++) {
                $result += $this->recursionByStorage($penny, $index + 1, $aim - $i * $penny[$index]);
            }
        }

        $this->handleSteps[] = '求解：index=' . $index . ',aim=' . $aim . '=>' . $result;
        $this->handleResult[$key] = $result;

        return $result;
    }

    /*
    |--------------------------------------------------------------------------
    | 动态规划
    |--------------------------------------------------------------------------
    |
    | 假设现在需要求解使用 1 和 2 面值的货币，组合出目标数额为 2 的方法数量。
    | 记数组 penny = [1,2]（下标从 0 开始）。
    | 记 f(i,j) 表示使用前 i+1 种货币，组合出数额为 j 的方法数量。
    | i 的下标从 0 开始，直到货币种类数量 -1。
    | j 的下标都从 0 开始（从后续的分析中可以发现这里需要定义 j 为 0 时的结果），直到目标数额。
    |
    | 通过分析可以得出如下关系：
    |   当 k = 0,1,2... 而且 j-k*penny[i] >= 0 时，
    |   f(i,j) = f(i-1,j) + f(i-1,j-0*penny[i]) +...+ f(i-1,j-k*penny[i])
    |
    | 举个例子：f(1,2) 表示使用 [1,2] 组合出目标数额为 2 的方法数量。
    |   通过上面的关系可以得出 f(1,2) = f(0,2) + f(0,0) 这个关系。
    |   f(0,2) = f(0,2-0*2) 即，面值为 2 的货币用 0 张。
    |   f(0,0) = f(0,2-1*2) 即，面值为 2 的货币用 1 张。
    |   关系式到这里就结束了，因为面值为 2 的货币用不了 2 张。
    |
    */

    /**
     * 动态规划求解
     *
     * @param array $penny [从小到大排好序的零钱数组]
     * @param int   $aim   [目标数值]
     * @return int
     */
    public function dynamicProgramming(array $penny, int $aim)
    {
        $dpResult = [];
        $index = count($penny);
        // 初始化矩阵第一行
        for ($j = 0; $j < $aim + 1; $j++) {
            $dpResult[0][$j] = $j % $penny[0] === 0 ? 1 : 0;
        }
        // 依次计算剩余部分的结果，外层循环是零钱数组，内层循环是目标数值
        for ($i = 1; $i < $index; $i++) {
            for ($j = 0; $j < $aim + 1; $j++) {
                $dpResult[$i][$j] = 0;
                for ($k = 0; $k * $penny[$i] <= $j; $k++) {
                    $dpResult[$i][$j] += $dpResult[$i - 1][$j - $k * $penny[$i]];
                }
            }
        }

        return $dpResult[$index - 1][$aim];
    }
}
