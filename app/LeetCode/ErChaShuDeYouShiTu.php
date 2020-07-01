<?php
/* ##### 二叉树的右视图 ##### */

// 给定一棵二叉树，想象自己站在它的右侧，按照从顶部到底部的顺序，返回从右侧所能看到的节点值。
//
// 示例:
// 输入: [1,2,3,null,5,null,4]
// 输出: [1, 3, 4]
// 解释:
//    1     <---
//  /  \
// 2    3   <---
//  \    \
//   5    4 <---

/* ##### 问题分析 ##### */

// 使用广度优先(层次)遍历，分层记录每一层的遍历结果，找到每一层最右侧的元素

/* ##### 代码 ##### */

require_once 'ErChaShu.php';

/**
 * @param TreeNode $root
 * @return Integer[]
 */
function rightSideView($root)
{
    if ($root === null || $root->val === null) {
        return [];
    }
    $queue = [];
    $nodeList = [];
    array_push($queue, $root);
    while ($length = count($queue)) {
        $tempResult = [];
        for ($i = 0; $i < $length; $i++) {
            $tNode = array_shift($queue);
            if ($tNode->val !== null) {
                // 用右侧的节点覆盖左侧的节点
                $tempResult = $tNode->val;
            }
            if ($tNode->left !== null) {
                array_push($queue, $tNode->left);
            }
            if ($tNode->right !== null) {
                array_push($queue, $tNode->right);
            }
        }
        $nodeList[] = $tempResult;
    }
    return $nodeList;
}

/* ##### 测试 ##### */

$numList = [1, 2, 3, null, 5, null, 4];
$numTree = makeTree($numList);
$testList = [$numTree];

$timeStart = intval(microtime(true) * 1000);
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = rightSideView($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => round(($timeStop - $timeStart) / count($testList), 2),
    'result' => $resultList
];
echo json_encode($echo);