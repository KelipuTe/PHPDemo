<?php
/* ##### 二叉树的最大深度 ##### */

// 给定一个二叉树，找出其最大深度。
// 二叉树的深度为根节点到最远叶子节点的最长路径上的节点数。
// 说明: 叶子节点是指没有子节点的节点。
//
// 示例：
// 给定二叉树 [3,9,20,null,null,15,7]，
//
//     3
//    / \
//   9  20
//     /  \
//    15   7
//
// 返回它的最大深度 3 。

/* ##### 问题分析 ##### */

// 使用深度优先遍历，记录每个节点的深度，找到最大深度

/* ##### 代码 ##### */

require_once 'ErChaShu.php';

/**
 * @param TreeNode $root
 * @return Integer
 */
function maxDepth($root)
{
    if ($root->val === null) {
        return 0;
    }
    $stack = [];
    $stackNode = ['treeNode' => $root, 'depth' => 1];
    $maxDepth = 0;
    // 根节点入栈
    array_push($stack, $stackNode);
    while (!empty($stack)) {
        $tStackNode = array_pop($stack);
        $tNode = $tStackNode['treeNode'];
        // 比较一下深度
        if ($maxDepth < $tStackNode['depth']) {
            $maxDepth = $tStackNode['depth'];
        }
        if ($tNode->right !== null) {
            $stackNode = ['treeNode' => $tNode->right, 'depth' => $tStackNode['depth'] + 1];
            array_push($stack, $stackNode);
        }
        if ($tNode->left !== null) {
            $stackNode = ['treeNode' => $tNode->left, 'depth' => $tStackNode['depth'] + 1];
            array_push($stack, $stackNode);
        }
    }
    return $maxDepth;
}

/* ##### 测试 ##### */

$numList = [3, 9, 20, null, null, 15, 7];
$numTree = makeTree($numList);
$testList = [$numTree];

$timeStart = intval(microtime(true) * 1000);
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = maxDepth($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => round(($timeStop - $timeStart) / count($testList), 2),
    'result' => $resultList
];
echo json_encode($echo);