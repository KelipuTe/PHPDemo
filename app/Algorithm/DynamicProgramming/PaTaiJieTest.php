<?php

namespace App\Algorithm\DynamicProgramming;


require 'PaTaiJie.php';

$steps = 5;
$handlerRecursionOnly = new PaTaiJie();
$handlerRecursionByStorage = new PaTaiJie();
$handlerDynamicProgramming = new PaTaiJie();

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
