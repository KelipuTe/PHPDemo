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
    $queue = [];
    $queueNode = ['treeNode' => $root, 'level' => 1];
    $levelData = [];
    array_unshift($queue, $queueNode);
    while (!empty($queue)) {
        $tQueueNode = array_pop($queue);
        $tNode = $tQueueNode['treeNode'];
        // 分层存放节点数据
        if ($tNode->val !== null) {
            if (isset($levelData['level_' . $tQueueNode['level']])) {
                // 新节点查到数组头部方便最后的遍历
                array_unshift($levelData['level_' . $tQueueNode['level']], $tNode->val);
            } else {
                $levelData['level_' . $tQueueNode['level']] = [$tNode->val];
            }
        }
        if ($tNode->left !== null) {
            $queueNode = ['treeNode' => $tNode->left, 'level' => $tQueueNode['level'] + 1];
            array_unshift($queue, $queueNode);
        }
        if ($tNode->right !== null) {
            $queueNode = ['treeNode' => $tNode->right, 'level' => $tQueueNode['level'] + 1];
            array_unshift($queue, $queueNode);
        }
    }
    // 获取最右侧节点
    $rightSee = [];
    foreach ($levelData as $row) {
        $rightSee[] = $row[0];
    }

    return $rightSee;
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