<?php
/* 二叉树 */

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
 * 用数组构造二叉树
 * 数组中的值表示从上到下从左到右依次表示二叉树的节点
 * 数组中的 null 值表示二叉树没有这个节点，但是数组里要体现，用于区分左右子树
 * @param $numList
 * @return TreeNode
 */
function makeTree($numList)
{
    // 空数组返回 null
    if (count($numList) === 0) return null;
    // 创建根节点
    $root = new TreeNode($numList[0]);
    for ($i = 1; $i < count($numList); $i++) {
        // 依次添加节点
        $node = new TreeNode($numList[$i]);
        insertNode($root, $node);
    }

    return $root;
}

/**
 * 以先序遍历的顺序插入节点（根左右）
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
        if ($tNode->left === null) {
            $tNode->left = $iNode;

            return $root;
        } else {
            array_unshift($queue, $tNode->left);
        }
        // 右节点后入队
        if ($tNode->right === null) {
            $tNode->right = $iNode;

            return $root;
        } else {
            array_unshift($queue, $tNode->right);
        }
    }
}

/**
 * 广度优先遍历，使用队列
 * @param $root
 * @return array
 */
function breadthFirstTraverse($root)
{
    $queue = [];
    $nodeList = [];
    // 根节点入队
    array_unshift($queue, $root);
    while (!empty($queue)) {
        // 持续输出节点，直到队列为空
        // 队尾元素出队
        $tNode = array_pop($queue);
        // 存放节点数据
        if ($tNode->val !== null) $nodeList[] = $tNode->val;
        // 左节点先入队，先遍历
        if ($tNode->left !== null) array_unshift($queue, $tNode->left);
        // 右节点后入队，后遍历
        if ($tNode->right !== null) array_unshift($queue, $tNode->right);
    }

    return $nodeList;
}

/**
 * 广度优先遍历，使用队列的另一种思路
 * 每一次遍历会把下一层所有的节点输入队列，可分层输出结果
 * @param $root
 * @return array
 */
function breadthFirstTraverse2($root)
{
    $nodeList = [];
    $level = 1;

    $queue = [];
    // 根节点入队
    array_push($queue, $root);
    while ($length = count($queue)) {
        // 持续输出节点，直到队列为空
        for ($i = 0; $i < $length; $i++) {
            // 弹出队列中第一个元素
            $tNode = array_shift($queue);
            if ($tNode->val !== null) $nodeList[$level][] = $tNode->val;
            // 左节点先入队，先遍历
            if ($tNode->left !== null) array_push($queue, $tNode->left);
            // 右节点后入队，后遍历
            if ($tNode->right !== null) array_push($queue, $tNode->right);
        }
        $level++;
    }

    return $nodeList;
}

/**
 * 深度优先遍历用栈
 * @param $root
 * @return mixed
 */
function depthFirstTraverse($root)
{
    $stack = [];
    $nodeList = [];
    // 根节点入栈
    array_push($stack, $root);
    while (!empty($stack)) {
        // 持续输出节点，直到栈为空
        // 栈顶元素出栈
        $tNode = array_pop($stack);
        // 存放节点数据
        if ($tNode->val !== null) $nodeList[] = $tNode->val;
        // 右节点先入栈，后遍历
        if ($tNode->right !== null) array_push($stack, $tNode->right);
        // 左节点后入栈，先遍历
        if ($tNode->left !== null) array_push($stack, $tNode->left);
    }

    return $nodeList;
}

/* 测试代码 */

// $numList = [1, 2, 3, null, 5, null, 4];
// $numTree = makeTree($numList);
// echo json_encode($numTree);