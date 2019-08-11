<?php

namespace App\AlgorithmDemo\DynamicProgramming\Handler;


/**
 * Class LongestCommonSequenceHandler
 * 最长公共子序列问题
 *
 * @package App\AlgorithmDemo\DynamicProgramming\Handler
 */
class LongestCommonSequenceHandler extends DynamicProgrammingHandlerAbstract
{
    /*
    |--------------------------------------------------------------------------
    | 问题描述
    |--------------------------------------------------------------------------
    |
    | 给定两个字符串 string1 和 string2，返回两个字符串的最长公共子序列的长度。
    | 例如：string1 = "1A2C3"，string2 = "B1D23"。
    |   则 "123" 是最长公共子序列，那么两字符串的最长公共子序列的长度为 3。
    |
    */

    /*
    |--------------------------------------------------------------------------
    | 数学建模
    |--------------------------------------------------------------------------
    |
    | 第一步：列出两个字符串所有的子序列。
    | 第二步：比较所有的子序列，找出最长公共子序列
    |
    */

    public function __construct()
    {
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | 动态规划
    |--------------------------------------------------------------------------
    |
    | 假设两字符串 string1 和 string2 的长度分别为 m 和 n。
    | 对于这类问题，我们一般可以构建一个 m * n 大小的矩阵 dp[][]。
    | 其中 dp[i][j] 代表的是 string1 中前 i 个字符串与 string2 中前 j 个字符串的最长公共子序列的长度。
    | 第一步：初始化矩阵的第一行和第一列。
    |   第一行："1" 与 "B"，"B1"，"B1D"，"B1D2"，"B1D23" 分别为 0,1,1,1,1
    |   第一列："B" 与 "1"，"1A"，"1A2"，"1A2C"，"1A2C3" 分别为 0,0,0,0,0
    | 第二步：从左至右，从上至下，依次计算。这里有两种情况。
    |   情况 1：string1[i] == string2[j]，这时 dp[i][j] = dp[i-1][j-1] + 1。
    |   举例："1A2" 和 "B1D2" 的最长子序列 "12" 就是 "1A" 和 "B1D" 的最长子序列 "1" 再加上 "2"。
    |   情况 2：string1[i] != string2[j]，这时 dp[i][j] = dp[i][j-1] 和 dp[i][j-1] 的最大值。
    |
    */

    /**
     * 动态规划求解
     *
     * @param string $string1
     * @param string $string2
     * @return int
     */
    public function dynamicProgramming(string $string1, string $string2)
    {
        $dpResult = [];
        $arrLCS = [];
        $strLCS = '';

        $strArray1 = str_split($string1);
        $strArray2 = str_split($string2);
        $arrLength1 = count($strArray1);
        $arrLength2 = count($strArray2);
        // 初始化矩阵第一列
        for ($i = 0; $i < $arrLength1; $i++) {
            if ($strArray1[$i] === $strArray2[0]) {
                $dpResult[$i][0] = 1;
                $arrLCS[0] = $strArray1[$i];
            } else {
                $dpResult[$i][0] = 0;
            }
            if ($i > 1 && $dpResult[$i - 1][0] >= 1) {
                $dpResult[$i][0] = $dpResult[$i - 1][0];
            }
        }
        // 初始化矩阵第一行
        for ($j = 1; $j < $arrLength2; $j++) {
            if ($strArray2[$j] === $strArray1[0]) {
                $dpResult[0][$j] = 1;
                $arrLCS[0] = $strArray2[$j];
            } else {
                $dpResult[0][$j] = 0;
            }
            if ($j > 1 && $dpResult[0][$j - 1] >= 1) {
                $dpResult[0][$j] = $dpResult[0][$j - 1];
            }
        }
        // 依次计算剩余部分的结果
        for ($i = 1; $i < $arrLength1; $i++) {
            for ($j = 1; $j < $arrLength2; $j++) {
                if ($strArray1[$i] === $strArray2[$j]) {
                    $dpResult[$i][$j] = $dpResult[$i - 1][$j - 1] + 1;
                    $arrLCS[] = $strArray1[$i];
                } else {
                    $dpResult[$i][$j] = max($dpResult[$i - 1][$j], $dpResult[$i][$j - 1]);
                }
            }
        }

        $strLCS = implode($arrLCS);

        return $strLCS;
    }
}
