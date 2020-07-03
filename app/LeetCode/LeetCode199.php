<?php
/* LeetCode199 二叉树的右视图 */

require_once 'ErChaShu.php';

/**
 * @param TreeNode $root
 * @return Integer[]
 */
function rightSideView($root)
{
    $nodeList = [];

    if ($root === null || $root->val === null) return [];

    $queue = [];
    array_push($queue, $root);
    while ($length = count($queue)) {
        $tempResult = [];
        for ($i = 0; $i < $length; $i++) {
            $tNode = array_shift($queue);
            // 用右侧的节点覆盖左侧的节点
            if ($tNode->val !== null) $tempResult = $tNode->val;
            if ($tNode->left !== null) array_push($queue, $tNode->left);
            if ($tNode->right !== null) array_push($queue, $tNode->right);

        }
        $nodeList[] = $tempResult;
    }

    return $nodeList;
}

/* 测试代码 */

$numList = [1, 2, 3, null, 5, null, 4];
$numTree = makeTree($numList);
$testList = [$numTree];
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = rightSideView($item);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);