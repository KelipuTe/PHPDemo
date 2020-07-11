<?php
/* LeetCode2 两数之和 */

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

require_once 'LianBiao.php';

/**
 * @param ListNode $l1
 * @param ListNode $l2
 * @return ListNode
 */
function addTwoNumbers($l1, $l2)
{
    $listHead = null;
    $listTail = null;
    $nextCarry = false;
    $l1Node = $l1;
    $l2Node = $l2;
    do {
        $prevCarry = $nextCarry ? 1 : 0;
        $l1Val = ($l1Node !== null) ? $l1Node->val : 0;
        $l2Val = ($l2Node !== null) ? $l2Node->val : 0;
        $thisVal = $prevCarry + $l1Val + $l2Val;

        $nextCarry = false;
        if ($thisVal >= 10) {
            $nextCarry = true;
            $thisVal -= 10;
        }

        $listNode = new ListNode($thisVal);
        if ($listHead === null) {
            $listHead = $listNode;
            $listTail = $listNode;
        } else {
            $listTail->next = $listNode;
            $listTail = $listNode;
        }
        if ($l1Node !== null) $l1Node = $l1Node->next;
        if ($l2Node !== null) $l2Node = $l2Node->next;
    } while ($l1Node !== null || $l2Node !== null || $nextCarry);

    return $listHead;
}

/* 测试代码 */

$testList = [
    ['num1' => 342, 'num2' => 46588],
    ['num1' => 5, 'num2' => 5],
    ['num1' => 0, 'num2' => 10],
];
foreach ($testList as $index => $item) {
    $testList[$index]['num1'] = makeListAsc($item['num1']);
    $testList[$index]['num2'] = makeListAsc($item['num2']);
}
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = addTwoNumbers($item['num1'], $item['num2']);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);
