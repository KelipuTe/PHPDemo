<?php

class PaTaiJie
{
    // 爬台阶问题

    public $handleSteps; // 求解步骤

    public $handleResult; // 求解结果

    /**
     * 递归暴力求解
     * @param int $steps
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
     * @param int $steps
     * @return int
     */
    public function recursionByStorage(int $steps)
    {
        if (isset($this->handleResult[$steps])) {
            // 如果发现已经计算过的结果则直接返回该结果
            return $this->handleResult[$steps];
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

$steps = 5;
$handlerRecursionOnly = new PaTaiJie();
$handlerRecursionByStorage = new PaTaiJie();
$handlerDynamicProgramming = new PaTaiJie();

$returnData = [
    'recursionOnly'      => [
        'resultNum'   => $handlerRecursionOnly->recursionOnly($steps),
        'handleSteps' => $handlerRecursionOnly->handleSteps
    ],
    'recursionByStorage' => [
        'resultNum'    => $handlerRecursionByStorage->recursionByStorage($steps),
        'handleSteps'  => $handlerRecursionByStorage->handleSteps,
        'handleResult' => $handlerRecursionByStorage->handleResult
    ],
    'dynamicProgramming' => [
        'resultNum' => $handlerDynamicProgramming->dynamicProgramming($steps)
    ]
];

echo json_encode($returnData);
