<?php
/* 二叉树 */

namespace App\ShuJuJieGou;

/**
 * 定义结点
 */
class TreeNode
{
    /**
     * @var int 结点值
     */
    public $value = null;

    /**
     * @var TreeNode 左子树
     */
    public $left = null;

    /**
     * @var TreeNode 右子树
     */
    public $right = null;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

/**
 * 用数组构造二叉树
 * @param array $numList
 * @return TreeNode
 */
function buildTreeWithArray($numList)
{
    // 空数组返回 null
    if (count($numList) === 0) return null;
    // 创建根结点
    $root = new TreeNode($numList[0]);
    for ($i = 1, $numLen = count($numList); $i < $numLen; $i++) {
        // 依次添加结点
        $node = new TreeNode($numList[$i]);
        insertNodeByNLR($root, $node);
    }

    return $root;
}

/**
 * 以先序遍历的顺序插入结点（根左右）
 * @param TreeNode $root
 * @param TreeNode $iNode
 * @return TreeNode
 */
function insertNodeByNLR($root, $iNode)
{
    $queue = [];
    // 根结点入队
    array_unshift($queue, $root);
    while (!empty($queue)) {
        // 持续遍历结点，直到队列为空
        // 队列元素出队
        $tNode = array_pop($queue);
        if ($tNode->left === null) {
            // 如果左结点为空就插入结点
            $tNode->left = $iNode;

            return $root;
        } else {
            // 左结点先入队
            array_unshift($queue, $tNode->left);
        }
        if ($tNode->right === null) {
            // 如果右结点为空就插入结点
            $tNode->right = $iNode;

            return $root;
        } else {
            // 右结点后入队
            array_unshift($queue, $tNode->right);
        }
    }
}

/**
 * 前序遍历
 * @param TreeNode $root
 */
function NLRTraverse($root)
{
    if ($root === null) return;
    if ($root->value === null) return;
    echo $root->value . ';';
    NLRTraverse($root->left);
    NLRTraverse($root->right);
}

/**
 * 中序遍历
 * @param TreeNode $root
 */
function LNRTraverse($root)
{
    if ($root === null) return;
    if ($root->value === null) return;
    LNRTraverse($root->left);
    echo $root->value . ';';
    LNRTraverse($root->right);
}

/**
 * 后序遍历
 * @param TreeNode $root
 */
function LRNTraverse($root)
{
    if ($root === null) return;
    if ($root->value === null) return;
    LRNTraverse($root->left);
    LRNTraverse($root->right);
    echo $root->value . ';';
}

/**
 * 计算二叉树的最大深度
 * @param TreeNode $root
 * @return int
 */
function maxDepth($root)
{
    if ($root === null) return 0;
    if ($root->value === null) return 0;
    $left = maxDepth($root->left);
    $right = maxDepth($root->right);

    return max($left, $right) + 1;
}

/**
 * 广度优先遍历
 * @param TreeNode $root
 * @return array
 */
function BFSTraverse($root)
{
    $nodeList = [];

    $queue = [];
    // 根结点入队
    array_unshift($queue, $root);
    while (!empty($queue)) {
        // 持续输出结点，直到队列为空
        // 队列元素出队
        $tNode = array_pop($queue);
        // 存放结点数据
        if ($tNode->value !== null) $nodeList[] = $tNode->value;
        // 左结点先入队，先遍历
        if ($tNode->left !== null) array_unshift($queue, $tNode->left);
        // 右结点后入队，后遍历
        if ($tNode->right !== null) array_unshift($queue, $tNode->right);
    }

    return $nodeList;
}

/**
 * 广度优先遍历，可分层输出结果
 * @param TreeNode $root
 * @return array
 */
function BFSTraverse2($root)
{
    $nodeList = [];
    $level = 1;

    $queue = [];
    // 根结点入队
    array_push($queue, $root);
    while ($length = count($queue)) {
        // 持续输出结点，直到队列为空
        for ($i = 0; $i < $length; $i++) {
            // 队列元素出队
            $tNode = array_shift($queue);
            if ($tNode->value !== null) $nodeList[$level][] = $tNode->value;
            // 左结点先入队，先遍历
            if ($tNode->left !== null) array_push($queue, $tNode->left);
            // 右结点后入队，后遍历
            if ($tNode->right !== null) array_push($queue, $tNode->right);
        }
        // 一层遍历结束，层数+1
        $level++;
    }

    return $nodeList;
}

/**
 * 深度优先遍历
 * @param TreeNode $root
 * @return array
 */
function DFSTraverse($root)
{
    $nodeList = [];

    $stack = [];
    // 根结点入栈
    array_push($stack, $root);
    while (!empty($stack)) {
        // 持续输出结点，直到栈为空
        // 栈顶元素出栈
        $tNode = array_pop($stack);
        // 存放结点数据
        if ($tNode->value !== null) $nodeList[] = $tNode->value;
        // 右结点先入栈，后遍历
        if ($tNode->right !== null) array_push($stack, $tNode->right);
        // 左结点后入栈，先遍历
        if ($tNode->left !== null) array_push($stack, $tNode->left);
    }

    return $nodeList;
}

/* 测试代码 */

$numList = [1, 2, 3, null, 5, null, 4];
$numTree = buildTreeWithArray($numList);
// echo json_encode($numTree);
// NLRTraverse($numTree);
// LNRTraverse($numTree);
// LRNTraverse($numTree);
// echo maxDepth($numTree);
// echo json_encode(BFSTraverse($numTree));
// echo json_encode(BFSTraverse2($numTree));
// echo json_encode(DFSTraverse($numTree));