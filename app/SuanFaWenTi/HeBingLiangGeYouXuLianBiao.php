<?php
/* ##### 合并两个有序链表 ##### */

// 将两个升序链表合并为一个新的 升序 链表并返回。新链表是通过拼接给定的两个链表的所有节点组成的。
//
// 示例：
// 输入：1->2->4, 1->3->4
// 输出：1->1->2->3->4->4

/* ##### 代码 ##### */

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
    if ($l1 === null) {
        return $l2;
    }
    if ($l2 === null) {
        return $l1;
    }
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

/* ##### 测试 ##### */

/* ##### 测试 ##### */

$testList = [
    [
        'arr1' => [1, 3, 5, 6, 7, 8, 9],
        'arr2' => []
    ]
];
foreach ($testList as $index => $item) {
    $testList[$index]['arr1'] = makeListAsc($item['arr1']);
    $testList[$index]['arr2'] = makeListAsc($item['arr2']);
}

$timeStart = intval(microtime(true) * 1000);
$resultList = [];
foreach ($testList as $item) {
    $resultList[] = mergeTwoLists($item['arr1'], $item['arr2']);
}
$timeStop = intval(microtime(true) * 1000);

$echo = [
    'timeStart' => $timeStart,
    'timeStop'  => $timeStop,
    'timePass'  => round(($timeStop - $timeStart) / count($testList), 2),
    'result'    => $resultList
];
echo json_encode($echo);

