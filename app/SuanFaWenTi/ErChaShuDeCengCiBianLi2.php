<?php
/* ##### 二叉树的层次遍历 II ##### */

// 给定一个二叉树，返回其节点值自底向上的层次遍历。 （即按从叶子节点所在层到根节点所在的层，逐层从左向右遍历）
//
// 例如：
// 给定二叉树 [3,9,20,null,null,15,7],
//
//      3
//     / \
//    9  20
//      /  \
//     15   7
//
// 返回其自底向上的层次遍历为：
// [
//   [15,7],
//   [9,20],
//   [3]
// ]

/* ##### 问题分析 ##### */

// 使用广度优先(层次)遍历，分层记录每一层的遍历结果

/* ##### 代码 ##### */

require_once 'ErChaShu.php';

/**
 * @param TreeNode $root
 * @return Integer[][]
 */
function levelOrderBottom($root)
{
    $queue = [];
    $nodeList = [];
    array_push($queue, $root);
    while ($length = count($queue)) {
        $tempResult = [];
        for ($i = 0; $i < $length; $i++) {
            $tNode = array_shift($queue);
            if ($tNode->val !== null) {
                $tempResult[] = $tNode->val;
            }
            if ($tNode->left !== null) {
                array_push($queue, $tNode->left);
            }
            if ($tNode->right !== null) {
                array_push($queue, $tNode->right);
            }
        }
        if (!empty($tempResult)) {
            array_unshift($nodeList, $tempResult);
        }
    }
    return $nodeList;
}

/* ##### 测试 ##### */

$numList = [3, 9, 20, null, null, 15, 7];
$numTree = makeTree($numList);
$testList = [$numTree];

$timeStart = intval(microtime(true) * 1000);
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = levelOrderBottom($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => round(($timeStop - $timeStart) / count($testList), 2),
    'result' => $resultList
];
echo json_encode($echo);