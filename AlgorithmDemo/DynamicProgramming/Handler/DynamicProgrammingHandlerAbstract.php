<?php

namespace App\AlgorithmDemo\DynamicProgramming\Handler;


abstract class DynamicProgrammingHandlerAbstract
{
    protected $handleSteps; // 求解步骤

    protected $handleResult; // 求解结果

    public function __construct()
    {
        $this->handleSteps = [];
        $this->handleResult = [];
    }

    public function getHandleSteps()
    {
        return $this->handleSteps;
    }

    public function getHandleResult()
    {
        return $this->handleResult;
    }
}
