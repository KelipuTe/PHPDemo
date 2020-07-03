<?php
/* LeetCode107 二叉树的层次遍历 II */

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
 * @param TreeNode $root
 * @return Integer[][]
 */
function levelOrderBottom($root)
{
    $nodeList = [];
    $level = 1;

    $queue = [];
    array_push($queue, $root);
    while ($length = count($queue)) {
        for ($i = 0; $i < $length; $i++) {
            $tNode = array_shift($queue);
            if ($tNode->val !== null) $nodeList[$level][] = $tNode->val;
            if ($tNode->left !== null) array_push($queue, $tNode->left);
            if ($tNode->right !== null) array_push($queue, $tNode->right);
        }
        $level++;
    }

    return array_reverse($nodeList);
}

/* 测试代码 */

$numList = [3, 9, 20, null, null, 15, 7];
$numTree = makeTree($numList);
$testList = [$numTree];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = levelOrderBottom($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);