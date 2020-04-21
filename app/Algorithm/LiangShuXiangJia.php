<?php

/* ##### 问题 ##### */

// 给出两个 非空 的链表用来表示两个非负的整数。其中，它们各自的位数是按照 逆序 的方式存储的，并且它们的每个节点只能存储 一位 数字。
// 如果，我们将这两个数相加起来，则会返回一个新的链表来表示它们的和。
// 您可以假设除了数字 0 之外，这两个数都不会以 0 开头。

// 示例：
// 输入：(2 -> 4 -> 3) + (5 -> 6 -> 4)
// 输出：7 -> 0 -> 8
// 原因：342 + 465 = 807

/* ##### 问题分析 ##### */

// 链表没啥需要注意的
// 需要注意的是两个数字链表可能不一样长
// 以及进位时的处理

/* ##### 代码 ##### */

/**
 * Definit
 * ion for a singly-linked list.
 */
class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val)
    {
        $this->val = $val;
    }
}

function makeList($num)
{
    if ($num === 0) {
        return new ListNode($num);
    }

    $listHead = null;
    $listTail = null;
    $i = 10;
    do {
        $listVal = $num % $i;
        $listNode = new ListNode($listVal);
        if ($listHead === null) {
            $listHead = $listNode;
            $listTail = $listNode;
        } else {
            $listTail->next = $listNode;
            $listTail = $listNode;
        }
        $num = (int)(($num - $listVal) / $i);
    } while ($num > 0);

    return $listHead;
}

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
        $l1Val = $l1Node !== null ? $l1Node->val : 0;
        $l2Val = $l2Node !== null ? $l2Node->val : 0;
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

        if ($l1Node !== null) {
            $l1Node = $l1Node->next;
        }
        if ($l2Node !== null) {
            $l2Node = $l2Node->next;
        }
    } while ($l1Node !== null || $l2Node !== null || $nextCarry);

    return $listHead;
}

/* ##### 测试 ##### */

// $num1 = 342;
// $num2 = 46588;

// $num1 = 5;
// $num2 = 5;

$num1 = 0;
$num2 = 10;

$l1 = makeList($num1);
$l2 = makeList($num2);

echo json_encode($l1);
echo '<br/>';
echo json_encode($l2);
echo '<br/>';
echo json_encode(addTwoNumbers($l1, $l2));
