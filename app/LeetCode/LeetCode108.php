<?php
/* LeetCode108 将有序数组转换为二叉搜索树 */

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */

require_once 'ErChaShu.php';

/**
 * @param Integer[] $nums
 * @return TreeNode
 */
function sortedArrayToBST($nums)
{
    return makeBST($nums, 0, count($nums) - 1);
}

function makeBST($nums, $left, $right)
{
    if ($left > $right) return null;
    $mid = intval(($left + $right) / 2);
    $treeNode = new TreeNode($nums[$mid]);
    $treeNode->left = makeBST($nums, $left, $mid - 1);
    $treeNode->right = makeBST($nums, $mid + 1, $right);

    return $treeNode;
}

/* 测试代码 */

$testList = [
    [],
    [0],
    [4, 8],
    [4, 6, 8],
    [-9, 4, 6, 8],
    [-10, -3, 0, 5, 9]
];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = sortedArrayToBST($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'resultList' => $resultList
];
echo json_encode($echo);
