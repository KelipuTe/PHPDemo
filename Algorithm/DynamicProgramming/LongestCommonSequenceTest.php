<?php

namespace App\Algorithm\DynamicProgramming;

$string1 = '1A2C3';
$string2 = 'B1D23';

$handlerDynamicProgramming = new LongestCommonSequence();

$returnData = [
    'string1'            => $string1,
    'string2'            => $string2,
    'dynamicProgramming' => [
        'strLCS' => $handlerDynamicProgramming->dynamicProgramming($string1, $string2)
    ]
];

echo $returnData;