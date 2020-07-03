<?php
/* LeetCode104 二叉树的最大深度 */

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
 * 递归解法
 * @param TreeNode $root
 * @return Integer
 */
function maxDepth($root)
{
    if ($root === null) return 0;
    $left = maxDepth($root->left);
    $right = maxDepth($root->right);
    return max($left, $right) + 1;
}

/* ##### 测试 ##### */

$numList = [3, 9, 20, null, null, 15, 7];
$numTree = makeTree($numList);
$testList = [$numTree];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = maxDepth($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);