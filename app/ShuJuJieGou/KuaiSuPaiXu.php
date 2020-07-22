<?php

namespace App\ShuJuJieGou;


require_once 'PaiXuAbstract.php';

/**
 * Class KuaiSuPaiXu [快速排序]
 * @package App\ShuJuJieGou
 */
class KuaiSuPaiXu extends PaiXuAbstract
{
    protected function doSort()
    {
        $this->afterSortList = $this->beforeSortList;
        $startIndex = 0;
        $endIndex = count($this->afterSortList) - 1;
        $this->quickSort($startIndex, $endIndex);
    }

    protected function quickSort($startIndex, $endIndex)
    {
        if ($startIndex >= $endIndex) {
            return;
        }
        $i = $startIndex;
        $j = $endIndex;
        // 设定第一个元素作为基准
        $middleNum = $this->afterSortList[$startIndex];
        // 这里两个循环会来回移动这个基准元素，最后基准元素会把序列分为，前半部分小于基准的，和后半部分大于基准的
        while ($j > $i) {
            ++$this->sortTimes;
            if ($this->afterSortList[$j] < $middleNum) {
                $tempNum = $this->afterSortList[$i];
                $this->afterSortList[$i] = $this->afterSortList[$j];
                $this->afterSortList[$j] = $tempNum;
                $this->sortSteps[] = json_encode($this->afterSortList);
                for ($i += 1; $i < $j; ++$i) {
                    ++$this->sortTimes;
                    if ($this->afterSortList[$i] > $middleNum) {
                        $tempNum = $this->afterSortList[$j];
                        $this->afterSortList[$j] = $this->afterSortList[$i];
                        $this->afterSortList[$i] = $tempNum;
                        $this->sortSteps[] = json_encode($this->afterSortList);
                        break;
                    }
                }
            }
            --$j;
        }
        // 最后分别递归处理前半部分和后半部分
        $this->quickSort($startIndex, $i);
        $this->quickSort($i + 1, $endIndex);
    }
}

/* 测试代码 */

$beforeSortList = [];
$length = 10;
for ($i = 0; $i < $length; $i++) {
    $beforeSortList[] = rand(1, 50);
}
$xuanZePaiXu = new KuaiSuPaiXu($beforeSortList);
echo json_encode($xuanZePaiXu->getSortResult());
