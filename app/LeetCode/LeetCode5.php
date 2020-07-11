<?php
/* LeetCode5 最长回文子串 */

/**
 * @param String $s
 * @return String
 */
function longestPalindrome($s)
{
    $len = strlen($s);
    if ($len === 0) return '';
    if ($len === 1 || $len === 2) return $s;

    $double = $len%2===0;

    $maxLen = 0;
    for ($i = 1; $i < $len - 1; ++$i) {
        $j = 1;
        if($double) {
            while ($i - $j >= 0 && $i + $j < $len) {
                if ($s[$i - $j] === $s[$i + $j]) ++$j;

            }
        }else{
            while ($i - $j >= 0 && $i + $j < $len) {
                if ($s[$i - $j] === $s[$i + $j]) ++$j;

            }
        }
    }
}