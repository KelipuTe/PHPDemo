<?php

namespace App\ShuJuJieGou;


require_once 'PaiXuAbstract.php';

/**
 * Class ChaRuPaiXu [插入排序]
 * @package App\ShuJuJieGou
 */
class ChaRuPaiXu extends PaiXuAbstract
{
    protected function doSort()
    {
        $this->afterSortList = $this->beforeSortList;
        $length = count($this->afterSortList);
        for ($i = 1; $i < $length; ++$i) {
            $j = $i;
            $tempNum = $this->afterSortList[$j];
            while ($j > 0 && $tempNum < $this->afterSortList[$j - 1]) {
                // 把当前数字和前面的有序数列依次进行比较，数列中大的数就后移一位
                ++$this->sortTimes;
                $afterSortList[$j] = $this->afterSortList[$j - 1];
                --$j;
            }
            // 把当前数字插入有序数列
            $this->afterSortList[$j] = $tempNum;
            $this->sortSteps[] = json_encode($this->afterSortList);
        }
    }
}

/* 测试代码 */

$beforeSortList = [];
$length = 10;
for ($i = 0; $i < $length; $i++) {
    $beforeSortList[] = rand(1, 50);
}
$xuanZePaiXu = new ChaRuPaiXu($beforeSortList);
echo json_encode($xuanZePaiXu->getSortResult());
