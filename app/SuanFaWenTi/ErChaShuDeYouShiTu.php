<?php
/* ##### 二叉树的右视图问题 ##### */

// 给定一棵二叉树，想象自己站在它的右侧，按照从顶部到底部的顺序，返回从右侧所能看到的节点值。

// 示例:
// 输入: [1,2,3,null,5,null,4]
// 输出: [1, 3, 4]
// 解释:
//    1            <---
//  /   \
// 2     3         <---
//  \     \
//   5     4       <---

/* ##### 问题分析 ##### */

/* ##### 代码 ##### */

/**
 * Definition for a binary tree node.
 */
class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($value)
    {
        $this->val = $value;
    }
}

/**
 * @param TreeNode $root
 * @return Integer[]
 */
function rightSideView($root)
{
    $tree = $root;
    $levelData = [];
    $queue = [];
    $queueNode = ['treeNode' => $tree, 'level' => 1];
    // 根节点入队
    array_unshift($queue, $queueNode);
    while (!empty($queue)) {
        // 持续输出节点，直到队列为空
        // 队尾元素出队
        $tQueueNode = array_pop($queue);
        $tNode = $tQueueNode['treeNode'];
        // 分层存放节点数据
        if ($tNode->val !== null) {
            if (isset($levelData['level_' . $tQueueNode['level']])) {
                array_unshift($levelData['level_' . $tQueueNode['level']], $tNode->val);
            } else {
                $levelData['level_' . $tQueueNode['level']] = [$tNode->val];
            }
        }
        // 左节点先入队
        if ($tNode->left !== null) {
            $queueNode = ['treeNode' => $tNode->left, 'level' => $tQueueNode['level'] + 1];
            array_unshift($queue, $queueNode);
        };
        // 右节点入队
        if ($tNode->right !== null) {
            $queueNode = ['treeNode' => $tNode->right, 'level' => $tQueueNode['level'] + 1];
            array_unshift($queue, $queueNode);
        };
    }

    $rightSee = [];
    foreach ($levelData as $row) {
        $rightSee[] = $row[0];
    }

    return $rightSee;
}

/**
 * 数组构造二叉树
 *
 * @param $numList
 * @return TreeNode
 */
function makeTree($numList)
{
    $root = new TreeNode($numList[0]);

    for ($i = 1; $i < count($numList); $i++) {
        $node = new TreeNode($numList[$i]);
        insertNode($root, $node);
    }

    return $root;
}

/**
 * 插入节点
 *
 * @param $root
 * @param $iNode
 * @return mixed
 */
function insertNode($root, $iNode)
{
    $queue = [];
    // 根节点入队
    array_unshift($queue, $root);

    while (!empty($queue)) {
        // 持续遍历节点，直到队列为空
        // 队尾元素出队
        $tNode = array_pop($queue);
        // 左节点先入队
        if ($tNode->left == null) {
            $tNode->left = $iNode;

            return $root;
        } else {
            array_unshift($queue, $tNode->left);
        }
        // 右节点入队
        if ($tNode->right == null) {
            $tNode->right = $iNode;

            return $root;
        } else {
            array_unshift($queue, $tNode->right);
        }
    }
}

/* ##### 测试 ##### */

$numList = [1, 2, 3, null, 5, null, 4];
$numTree = makeTree($numList);

echo json_encode($numTree);
echo '<br/>';
echo json_encode(rightSideView($numTree));