<?php
/* ##### 回文数 ##### */

// 判断一个整数是否是回文数。回文数是指正序（从左向右）和倒序（从右向左）读都是一样的整数。
//
// 示例 1:
// 输入: 121
// 输出: true
//
// 示例 2:
// 输入: -121
// 输出: false
// 解释: 从左向右读, 为 -121 。 从右向左读, 为 121- 。因此它不是一个回文数。
//
// 示例 3:
// 输入: 10
// 输出: false
// 解释: 从右向左读, 为 01 。因此它不是一个回文数。
//
// 进阶:
// 你能不将整数转为字符串来解决这个问题吗？

/**
 * @param Integer $x
 * @return Boolean
 */
function isPalindrome($x)
{
    if ($x < 0) {
        return false;
    }

    $numArr = [];
    while ($x > 0) {
        $numArr[] = $x % 10;
        $x = intval($x / 10);
    }

    $numLength = count($numArr);
    for ($i = 0; $i < intval($numLength / 2); $i++) {
        if ($numArr[$i] !== $numArr[$numLength - 1 - $i]) {
            return false;
        }
    }
    return true;
}

/**
 * 不将整数转为字符串
 * @param Integer $x
 * @return Boolean
 */
function isPalindrome2($x)
{
    if ($x < 0) {
        return false;
    }
    $length = 1;
    while ($x >= pow(10, $length)) {
        $length++;
    }
    for ($i = 0; $i < intval($length / 2); $i++) {
        $left = intval($x / pow(10, $length - 1 - $i)) % pow(10, 1 + $i);
        $left = $left % 10;
        $right = intval($x % pow(10, 1 + $i) / pow(10, $i));
        if ($left !== $right) {
            return false;
        }
    }
    return true;
}

$x = 10;
// $xResult = isPalindrome($x);
// echo json_encode($xResult);

$xResult2 = isPalindrome2($x);
echo json_encode($xResult2);