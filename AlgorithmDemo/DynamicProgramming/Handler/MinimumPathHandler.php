<?php

namespace App\AlgorithmDemo\DynamicProgramming\Handler;


/**
 * Class MinimumPathHandler
 * 最小路径问题
 *
 * @package App\AlgorithmDemo\DynamicProgramming\Handler
 */
class MinimumPathHandler extends DynamicProgrammingHandlerAbstract
{
    /*
    |--------------------------------------------------------------------------
    | 问题描述
    |--------------------------------------------------------------------------
    |
    | 设：有一个矩阵 matrix，它的每个元素对应一个权值。
    |   从左上角的位置开始每次只能向右或者向下走，最后到达右下角的位置。
    |   路径上所有的权值累加起来就是路径和。
    | 问：所有的路径中最小的路径和是多少。
    |
    */

    /*
    |--------------------------------------------------------------------------
    | 数学建模
    |--------------------------------------------------------------------------
    |
    | 设：f(x,y) 记录从 [0,0] 到 [x,y] 位置的最小的路径和。
    | 通过分析，可以发现这样一个规律：
    | 对于第一行元素：f(0,j) = f(0,j-1) + matrix(0,j)。
    | 对于第一列元素：f(i,0) = f(i-1,0) + matrix(i,0)。
    | 对于中间的元素：f(i,j) = f(i-1,j) 和 f(i,j-1) 中的最小值与 matrix(i,j) 的和。
    |
    */

    private $matrix; // 路径矩阵

    private $row; // 矩阵行数

    private $column; // 矩阵列数

    public function __construct(array $matrix, int $row, int $column)
    {
        parent::__construct();

        $this->matrix = $matrix;
        $this->row = $row;
        $this->column = $column;
    }

    public function getMatrix()
    {
        $matrixShow = [];
        for ($i = 0; $i < $this->row; $i++) {
            // 补 0 方便输出后观察
            if ($this->matrix[$i][0] < 10) {
                $rowShow = '0' . $this->matrix[$i][0];
            } else {
                $rowShow = $this->matrix[$i][0];
            }
            for ($j = 1; $j < $this->column; $j++) {
                if ($this->matrix[$i][$j] < 10) {
                    $rowShow .= ',0' . $this->matrix[$i][$j];
                } else {
                    $rowShow .= ',' . $this->matrix[$i][$j];
                }
            }
            $matrixShow[] = $rowShow;
        }
        return $matrixShow;
    }

    /**
     * 递归暴力求解
     *
     * @param int $m
     * @param int $n
     * @return int
     */
    public function recursionOnly(int $m, int $n)
    {
        if ($m === 1 && $n === 1) {
            $this->handleSteps[] = '求解：[' . $m . ',' . $n . ']=' . $this->matrix[0][0];

            return $this->matrix[0][0];
        }
        $result = $this->matrix[$m - 1][$n - 1];
        if ($m === 1 && $n > 1) {
            $result += $this->recursionOnly($m, $n - 1);
        } else if ($m > 1 && $n === 1) {
            $result += $this->recursionOnly($m - 1, $n);
        } else {
            $result += min($this->recursionOnly($m, $n - 1), $this->recursionOnly($m - 1, $n));
        }

        $this->handleSteps[] = '求解：[' . $m . ',' . $n . ']=' . $result;

        return $result;
    }

    /**
     * 递归暴力求解的优化方案：记录结果
     *
     * @param int $m
     * @param int $n
     * @return int
     */
    public function recursionByStorage(int $m, int $n)
    {
        $key = $m . '_' . $n;

        if (isset($this->handleResult[$key])) {
            return $this->handleResult[$key]; // 计算过的直接取值
        }

        if ($m === 1 && $n === 1) {
            $this->handleSteps[] = '求解：[' . $m . ',' . $n . ']=' . $this->matrix[0][0];
            $this->handleResult[$key] = $this->matrix[0][0];

            return $this->matrix[0][0];
        }
        $result = $this->matrix[$m - 1][$n - 1];
        if ($m === 1 && $n > 1) {
            $result += $this->recursionByStorage($m, $n - 1);
        } else if ($m > 1 && $n === 1) {
            $result += $this->recursionByStorage($m - 1, $n);
        } else {
            $result += min($this->recursionByStorage($m, $n - 1), $this->recursionByStorage($m - 1, $n));
        }

        $this->handleSteps[] = '求解：[' . $m . ',' . $n . ']=' . $result;
        $this->handleResult[$key] = $result;

        return $result;
    }

    /*
    |--------------------------------------------------------------------------
    | 动态规划
    |--------------------------------------------------------------------------
    |
    | 如果把各个位置的最小路径和的结果，记为一个二位数组 dp[][]，
    | 则 dp[m][n]（m,n 从 0 开始记）对应的值就是 [0,0] 到 [m,n] 位置的最小路径和。
    | 先求出第一行和第一列的结果，在此基础之上就可以依次求出各个点的结果。
    | 这时递归结构就可以去掉了。
    |
    */

    /**
     * 动态规划求解
     *
     * @param int $m
     * @param int $n
     * @return int
     */
    public function dynamicProgramming(int $m, int $n)
    {
        $dpResult = [];
        $dpResult[0][0] = $this->matrix[0][0];

        for ($i = 1; $i < $m; $i++) {
            $dpResult[$i][0] = $this->matrix[$i][0] + $dpResult[$i - 1][0];
        }
        for ($j = 1; $j < $n; $j++) {
            $dpResult[0][$j] = $this->matrix[0][$j] + $dpResult[0][$j - 1];
        }

        for ($i = 1; $i < $m; $i++) {
            for ($j = 1; $j < $n; $j++) {
                $dpResult[$i][$j] = $this->matrix[$i][$j] + min($dpResult[$i - 1][$j], $dpResult[$i][$j - 1]);
            }
        }

        return $dpResult[$m - 1][$n - 1];
    }
}
