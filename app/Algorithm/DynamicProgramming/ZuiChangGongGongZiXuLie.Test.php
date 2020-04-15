<?php

namespace App\Algorithm\DynamicProgramming;


require 'ZuiChangGongGongZiXuLie.php';

$string1 = '1A2C3';
$string2 = 'B1D23';

$handlerDynamicProgramming = new ZuiChangGongGongZiXuLie();

$returnData = [
    'string1'            => $string1,
    'string2'            => $string2,
    'dynamicProgramming' => [
        'strLCS' => $handlerDynamicProgramming->dynamicProgramming($string1, $string2)
    ]
];

echo json_encode($returnData);
