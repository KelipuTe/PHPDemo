<?php

namespace App\Algorithm\DynamicProgramming;


require 'ClimbingSteps.php';

$steps = 5;
$handlerRecursionOnly = new ClimbingSteps();
$handlerRecursionByStorage = new ClimbingSteps();
$handlerDynamicProgramming = new ClimbingSteps();

$returnData = [
    'recursionOnly'      => [
        'resultNum'   => $handlerRecursionOnly->recursionOnly($steps),
        'handleSteps' => $handlerRecursionOnly->getHandleSteps()
    ],
    'recursionByStorage' => [
        'resultNum'    => $handlerRecursionByStorage->recursionByStorage($steps),
        'handleSteps'  => $handlerRecursionByStorage->getHandleSteps(),
        'handleResult' => $handlerRecursionByStorage->getHandleResult()
    ],
    'dynamicProgramming' => [
        'resultNum' => $handlerDynamicProgramming->dynamicProgramming($steps)
    ]
];

echo json_encode($returnData);
