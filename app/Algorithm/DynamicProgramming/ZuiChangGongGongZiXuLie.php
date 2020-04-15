<?php

namespace App\Algorithm\DynamicProgramming;


require_once 'DynamicProgrammingAbstract.php';

class ZuiChangGongGongZiXuLie extends DynamicProgrammingAbstract
{
    // 最长公共子序列问题

    public function __construct()
    {
        parent::__construct();
    }

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
