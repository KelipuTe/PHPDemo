<?php

namespace App\Algorithm\DynamicProgramming;


require_once 'DynamicProgrammingAbstract.php';

class ZhaoLingQian extends DynamicProgrammingAbstract
{
    // 找零钱问题

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
