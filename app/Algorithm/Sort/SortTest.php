<?php

namespace App\Algorithm\Sort;


require 'BubbleSort.php';
require 'InsertionSort.php';
require 'MergeSort.php';
require 'QuickSort.php';
require 'SelectionSort.php';

$arrayData = [];
$arrayNum = 8;
for ($i = 0; $i < $arrayNum; $i++) {
    $arrayData[] = rand(1, 20);
}

$bubbleSortResult = (new BubbleSort($arrayData))->sort();
$insertionSortResult = (new InsertionSort($arrayData))->sort();
$mergeSortResult = (new MergeSort($arrayData))->sort();
$quickSortResult = (new QuickSort($arrayData))->sort();
$selectionSortResult = (new SelectionSort($arrayData))->sort();

$returnData = [
    'basicData'           => [
        'arrayData' => $arrayData,
        'arrayNum'  => $arrayNum,
    ],
    'bubbleSort'          => $bubbleSortResult,
    'mergeSort'           => $mergeSortResult,
    'quickSort'           => $quickSortResult,
    'selectionSortResult' => $selectionSortResult,
    'insertionSortResult' => $insertionSortResult,
];

echo json_encode($returnData);
