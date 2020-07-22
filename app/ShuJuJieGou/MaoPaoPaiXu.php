<?php

namespace App\ShuJuJieGou;


require_once 'PaiXuAbstract.php';

/**
 * Class MaoPaoPaiXu [冒泡排序]
 * @package App\ShuJuJieGou
 */
class MaoPaoPaiXu extends PaiXuAbstract
{
    protected function doSort()
    {
        $this->afterSortList = $this->beforeSortList;
        $length = count($this->afterSortList);
        // 记录最后一个被交换的元素的位置
        $lastExchangeIndex = $length - 1;
        for ($i = 0; $i < $length - 1; $i++) {
            // 记录数组中是否有元素被交换
            $isSorted = false;
            // 下一轮内层循环，只比较到最后一个被交换的元素的位置
            $lastSortIndex = $lastExchangeIndex;
            for ($j = 0; $j < $lastSortIndex; $j++) {
                ++$this->sortTimes;
                if ($this->afterSortList[$j] > $this->afterSortList[$j + 1]) {
                    $tempNum = $this->afterSortList[$j + 1];
                    $this->afterSortList[$j + 1] = $this->afterSortList[$j];
                    $this->afterSortList[$j] = $tempNum;
                    $this->sortSteps[] = json_encode($this->afterSortList);

                    $isSorted = true;
                    $lastExchangeIndex = $j;
                }
            }
            if (!$isSorted) {
                // 如果数组中没有元素被交换，则数组已经有序
                break;
            }
        }
    }
}

/* 测试代码 */

$beforeSortList = [];
$length = 10;
for ($i = 0; $i < $length; $i++) {
    $beforeSortList[] = rand(1, 50);
}
$xuanZePaiXu = new MaoPaoPaiXu($beforeSortList);
echo json_encode($xuanZePaiXu->getSortResult());
