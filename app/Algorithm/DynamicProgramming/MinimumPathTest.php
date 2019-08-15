<?php

namespace App\Algorithm\DynamicProgramming;


require 'MinimumPath.php';

$row = 3;
$column = 3;
$matrix = [];
for ($i = 0; $i < $row; $i++) {
    for ($j = 0; $j < $column; $j++) {
        $matrix[$i][$j] = rand(1, 20);
    }
}

$handlerRecursionOnly = new MinimumPath($matrix, $row, $column);
$handlerRecursionByStorage = new MinimumPath($matrix, $row, $column);
$handlerDynamicProgramming = new MinimumPath($matrix, $row, $column);

$m = 3;
$n = 3;
$returnData = [
    'matrix'             => $handlerRecursionOnly->getMatrix(),
    'recursionOnly'      => [
        'resultNum'   => $handlerRecursionOnly->recursionOnly($m, $n),
        'handleSteps' => $handlerRecursionOnly->getHandleSteps()
    ],
    'recursionByStorage' => [
        'resultNum'    => $handlerRecursionByStorage->recursionByStorage($m, $n),
        'handleSteps'  => $handlerRecursionByStorage->getHandleSteps(),
        'handleResult' => $handlerRecursionByStorage->getHandleResult()
    ],
    'dynamicProgramming' => [
        'resultNum' => $handlerDynamicProgramming->dynamicProgramming($m, $n)
    ]
];

echo json_encode($returnData);
