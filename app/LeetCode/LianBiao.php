<?php
/* ##### 链表 ##### */

/**
 * Definition for a singly-linked list.
 */
class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

/**
 * 数组构造链表（顺序）
 * @param $numList
 * @return ListNode
 */
function makeListAsc($numList)
{
    if(empty($numList)){
        return null;
    }
    $head = new ListNode($numList[0]);
    $tail = $head;
    for ($i = 1; $i < count($numList); $i++) {
        $node = new ListNode($numList[$i]);
        $tail->next = $node;
        $tail = $node;
    }

    return $head;
}

/**
 * 数组构造链表（倒序）
 * @param $numList
 * @return ListNode
 */
function makeListDesc($numList)
{
    if(empty($numList)){
        return null;
    }
    $length = count($numList);
    $root = new ListNode($numList[$length - 1]);
    for ($i = $length - 2; $i >= 0; $i--) {
        $root = new ListNode($numList[$i], $root);
    }

    return $root;
}

/**
 * 数字构造链表
 * @param $num
 * @return ListNode|null
 */
function makeList($num)
{
    if ($num === 0) {
        return new ListNode($num);
    }
    $listHead = null;
    $listTail = null;
    do {
        // 数字每次对 10 取余，获得最后一位
        $listVal = $num % 10;
        $listNode = new ListNode($listVal);
        if ($listHead === null) {
            $listHead = $listNode;
            $listTail = $listNode;
        } else {
            $listTail->next = $listNode;
            $listTail = $listNode;
        }
        $num = (int)(($num - $listVal) / 10);
    } while ($num > 0);

    return $listHead;
}
