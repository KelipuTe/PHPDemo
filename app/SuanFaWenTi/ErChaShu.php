<?php
/* ##### 二叉树 ##### */

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
 * 数组构造二叉树
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