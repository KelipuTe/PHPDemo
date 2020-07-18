<?php

namespace App\SuanFa\PaiXu;

/**
 * 选择排序
 * Class XuanZePaiXu
 */
class XuanZePaiXu extends PaiXuAbstract
{


    /**
     * 选择排序
     */
    protected function doSort()
    {
        $afterSortList = $this->beforeSortList;
        $length = count($afterSortList);
        for ($i = 0; $i < $length; $i++) {
            // 第n次循环找到第n小的那个元素
            $minIndex = $i;
            for ($j = $i + 1; $j < $length; $j++) {
                // 记录排序比较次数
                ++$this->sortTimes;
                if ($afterSortList[$j] < $afterSortList[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // 把第n小的值和序列第n个位置的元素交换
            $tempNum = $afterSortList[$i];
            $afterSortList[$i] = $afterSortList[$minIndex];
            $afterSortList[$minIndex] = $tempNum;
            // 记录排序步骤
            $this->sortSteps[] = json_encode($afterSortList);
        }
        $this->afterSortList = $afterSortList;
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
