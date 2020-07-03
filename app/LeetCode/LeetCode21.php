<?php
/* LeetCode21 合并两个有序链表 */

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */

require_once 'LianBiao.php';

/**
 * @param ListNode $l1
 * @param ListNode $l2
 * @return ListNode
 */
function mergeTwoLists($l1, $l2)
{
    $head = null;
    $l = null;
    if ($l1 === null) return $l2;
    if ($l2 === null) return $l1;

    if ($l1->val < $l2->val) {
        $head = $l1;
        $l = $l1;
        $l1 = $l1->next;
    } else {
        $head = $l2;
        $l = $l2;
        $l2 = $l2->next;
    }
    while (1) {
        if ($l1 === null) {
            $l->next = $l2;
            break;
        }
        if ($l2 === null) {
            $l->next = $l1;
            break;
        }
        if ($l1->val < $l2->val) {
            $l->next = $l1;
            $l = $l->next;
            $l1 = $l1->next;
        } else {
            $l->next = $l2;
            $l = $l->next;
            $l2 = $l2->next;
        }
    }

    return $head;
}

/* 测试代码 */

$testList = [
    ['arr1' => [1, 3, 5, 6, 7, 8, 9], 'arr2' => []]
];
foreach ($testList as $index => $item) {
    $testList[$index]['arr1'] = makeListAsc($item['arr1']);
    $testList[$index]['arr2'] = makeListAsc($item['arr2']);
}
$resultList = [];

$timeStart = intval(microtime(true) * 1000);
foreach ($testList as $item) {
    $resultList[] = mergeTwoLists($item['arr1'], $item['arr2']);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop' => $timeStop,
    'timePass' => $timeStop - $timeStart,
    'result' => $resultList
];
echo json_encode($echo);

