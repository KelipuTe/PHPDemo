<?php


namespace App\ShuJuJieGou;


require_once 'PaiXuAbstract.php';

/**
 * Class GuiBingPaiXu [归并排序]
 * @package App\ShuJuJieGou
 */
class GuiBingPaiXu extends PaiXuAbstract
{
    protected function doSort()
    {
        $this->afterSortList = $this->beforeSortList;
        $startIndex = 0;
        $endIndex = count($this->afterSortList) - 1;
        $this->guiBingPaiXu($startIndex, $endIndex);
    }

    protected function guiBingPaiXu($startIndex, $endIndex)
    {
        ++$this->sortTimes;
        if ($startIndex < $endIndex) {
            $middleIndex = intval(floor(($startIndex + $endIndex) / 2));
            $this->guiBingPaiXu($startIndex, $middleIndex);
            $this->guiBingPaiXu($middleIndex + 1, $endIndex);
            $this->heBingXuLie($startIndex, $middleIndex, $endIndex);
        }
    }

    protected function heBingXuLie($startIndex, $middleIndex, $endIndex)
    {
        $i = $startIndex;
        $j = $middleIndex + 1;
        $k = $startIndex;
        $tempArray = [];
        while ($i !== $middleIndex + 1 && $j !== $endIndex + 1) {
            // 当两个序列都没有到头，需要比较哪个序列的第一个元素更小
            if ($this->afterSortList[$i] >= $this->afterSortList[$j]) {
                $tempArray[$k++] = $this->afterSortList[$j++];
            } else {
                $tempArray[$k++] = $this->afterSortList[$i++];
            }
        }
        while ($i !== $middleIndex + 1) {
            // 当前面的序列已经到头，直接把后面序列的元素依次赋值
            $tempArray[$k++] = $this->afterSortList[$i++];
        }
        while ($j !== $endIndex + 1) {
            // 当后面的序列已经到头，直接把前面序列的元素依次赋值
            $tempArray[$k++] = $this->afterSortList[$j++];
        }
        for ($i = $startIndex; $i <= $endIndex; $i++) {
            // 把排序好的序列替换到原序列的位置
            $this->afterSortList[$i] = $tempArray[$i];
        }
        $this->sortSteps[] = json_encode($this->afterSortList);
    }
}

/* 测试代码 */

$beforeSortList = [];
$length = 10;
for ($i = 0; $i < $length; $i++) {
    $beforeSortList[] = rand(1, 50);
}
$xuanZePaiXu = new GuiBingPaiXu($beforeSortList);
echo json_encode($xuanZePaiXu->getSortResult());
