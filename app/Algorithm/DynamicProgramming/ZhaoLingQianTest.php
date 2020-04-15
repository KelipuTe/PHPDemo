<?php

namespace App\Algorithm\DynamicProgramming;

require 'ZhaoLingQian.php';

$penny = [1, 2, 3];
$aim = 6;

$handlerRecursionOnly = new ZhaoLingQian();
$handlerRecursionByStorage = new ZhaoLingQian();
$handlerDynamicProgramming = new ZhaoLingQian();

$returnData = [
    'penny'              => $penny,
    'aim'                => $aim,
    'recursionOnly'      => [
        'resultNum'   => $handlerRecursionOnly->recursionOnly($penny, 0, $aim),
        'handleSteps' => $handlerRecursionOnly->getHandleSteps()
    ],
    'recursionByStorage' => [
        'resultNum'    => $handlerRecursionByStorage->recursionByStorage($penny, 0, $aim),
        'handleSteps'  => $handlerRecursionByStorage->getHandleSteps(),
        'handleResult' => $handlerRecursionByStorage->getHandleResult()
    ],
    'dynamicProgramming' => [
        'resultNum' => $handlerDynamicProgramming->dynamicProgramming($penny, $aim)
    ]
];

echo json_encode($returnData);
