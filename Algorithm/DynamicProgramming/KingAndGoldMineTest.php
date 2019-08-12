<?php

namespace App\Algorithm\DynamicProgramming;

require 'KingAndGoldMine.php';

$goldMine = ['400-5', '500-5', '200-3', '300-4', '350-3'];
$workerNumber = 10;

$handlerDynamicProgramming = new KingAndGoldMine();

$returnData = [
    'goldMine'           => $goldMine,
    'workerNumber'       => $workerNumber,
    'dynamicProgramming' => [
        'maxGold' => $handlerDynamicProgramming->dynamicProgramming($goldMine, $workerNumber)
    ]
];

echo $returnData;
