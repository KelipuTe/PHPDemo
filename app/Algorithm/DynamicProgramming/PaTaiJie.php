<?php

namespace App\Algorithm\DynamicProgramming;


require_once 'DynamicProgrammingAbstract.php';

class PaTaiJie extends DynamicProgrammingAbstract
{
    // 爬台阶问题

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
