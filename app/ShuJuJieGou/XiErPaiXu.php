<?php

namespace App\ShuJuJieGou;


require_once 'PaiXuAbstract.php';

/**
 * Class XiErPaiXu [希尔排序]
 * @package App\ShuJuJieGou
 */
class XiErPaiXu extends PaiXuAbstract
{
    protected function doSort()
    {
        $this->afterSortList = $this->beforeSortList;
        $length = count($this->afterSortList);
        $range = intval(floor($length / 2));
        while ($range > 0) {
            for ($i = $range; $i < $length; ++$i) {
                $tempNum = $this->afterSortList[$i];
                $j = $i - $range;
                while ($j >= 0 && $this->afterSortList[$j] > $tempNum) {
                    ++$this->sortTimes;
                    $this->afterSortList[$j + $range] = $this->afterSortList[$j];
                    $j -= $range;
                }
                $this->afterSortList[$j + $range] = $tempNum;
                $this->sortSteps[] = json_encode($this->afterSortList);
            }
            $range = intval(floor($range / 2));
        }
    }
}

/* 测试代码 */

$beforeSortList = [];
$length = 10;
for ($i = 0; $i < $length; $i++) {
    $beforeSortList[] = rand(1, 50);
}
$xuanZePaiXu = new XiErPaiXu($beforeSortList);
echo json_encode($xuanZePaiXu->getSortResult());