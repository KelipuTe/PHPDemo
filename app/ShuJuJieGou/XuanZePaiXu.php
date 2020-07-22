<?php

namespace App\ShuJuJieGou;


require_once 'PaiXuAbstract.php';

/**
 * Class XuanZePaiXu [选择排序]
 * @package App\ShuJuJieGou
 */
class XuanZePaiXu extends PaiXuAbstract
{
    protected function doSort()
    {
        $this->afterSortList = $this->beforeSortList;
        $length = count($this->afterSortList);
        for ($i = 0; $i < $length; $i++) {
            // 第n次循环找到第n小的那个元素
            $minIndex = $i;
            for ($j = $i + 1; $j < $length; $j++) {
                ++$this->sortTimes;
                if ($this->afterSortList[$j] < $this->afterSortList[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // 把第n小的值和序列第n个位置的元素交换
            $tempNum = $this->afterSortList[$i];
            $this->afterSortList[$i] = $this->afterSortList[$minIndex];
            $this->afterSortList[$minIndex] = $tempNum;
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
$xuanZePaiXu = new XuanZePaiXu($beforeSortList);
echo json_encode($xuanZePaiXu->getSortResult());
