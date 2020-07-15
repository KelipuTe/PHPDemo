<?php

namespace App\ShuJuJieGou;


require_once 'HaFuManShuJieDian.php';

/**
 * 哈夫曼树
 * Class HaFuManShu
 * @package App\ShuJuJieGou
 */
class HaFuManShu
{
    /**
     * @var string [目标字符串]
     */
    protected $muBiaoZiFuZhuan;

    /**
     * @var array [字符权重列表]
     */
    protected $ziFuQuanZhongMap;

    /**
     * @var HaFuManShuJieDian [根结点]
     */
    protected $genJieDian;

    public function __construct()
    {
        $this->muBiaoZiFuZhuan = '';
        $this->ziFuQuanZhongMap = [];
        $this->genJieDian = null;
    }

    /**
     * 设置目标字符串并计算字符数目
     * @param string $string
     */
    public function setMuBiaoZiFuChuan($string)
    {
        $this->muBiaoZiFuZhuan = $string;
        for ($i = 0, $strLen = strlen($string); $i < $strLen; ++$i) {
            if (isset($this->ziFuQuanZhongMap[$string[$i]])) ++$this->ziFuQuanZhongMap[$string[$i]];
            else $this->ziFuQuanZhongMap[$string[$i]] = 1;
        }
        // 字符权重列表升序排序
        asort($this->ziFuQuanZhongMap);
    }

    /**
     * 构造哈夫曼树
     */
    public function gouZaoHaFuManShu()
    {
        $ziFuQuanZhongMap = $this->ziFuQuanZhongMap;
        $tempJieDianMap = [];
        $tempJieDianId = 1;
        while (count($ziFuQuanZhongMap) > 1) {
            // 获取第一个结点
            reset($ziFuQuanZhongMap);
            $keyZiFu1 = key($ziFuQuanZhongMap);
            $quanZhong1 = $ziFuQuanZhongMap[$keyZiFu1];
            if (isset($ziFuQuanZhongMap[$keyZiFu1])) {
                $treeNode1 = $tempJieDianMap[$keyZiFu1];
                unset($ziFuQuanZhongMap[$keyZiFu1]);
            } else {
                $treeNode1 = new HaFuManShuJieDian($keyZiFu1, $quanZhong1);
            }
            // 获取第二个结点
            next($ziFuQuanZhongMap);
            $keyZiFu2 = key($ziFuQuanZhongMap);
            $quanZhong2 = $ziFuQuanZhongMap[$keyZiFu2];
            if (isset($ziFuQuanZhongMap[$keyZiFu1])) {
                $treeNode2 = $tempJieDianMap[$keyZiFu2];
                unset($ziFuQuanZhongMap[$keyZiFu2]);
            } else {
                $treeNode2 = new HaFuManShuJieDian($keyZiFu2, $quanZhong2);
            }
            // 构造上层结点
            $shangCengQuanZhong = $treeNode1->quanZhong + $treeNode2->quanZhong;
            $shangCengTreeNode = new HaFuManShuJieDian($tempJieDianId, $shangCengQuanZhong);
            if ($treeNode1->quanZhong <= $treeNode2->quanZhong) {
                $shangCengTreeNode->zuoZhiZhen = $treeNode1;
                $shangCengTreeNode->youZhiZhen = $treeNode2;
            } else {
                $shangCengTreeNode->zuoZhiZhen = $treeNode2;
                $shangCengTreeNode->youZhiZhen = $treeNode1;
            }
            // 将构造好的结点放回权重数组并升序排序
            $ziFuQuanZhongMap['temp_'.$tempJieDianId] = $shangCengQuanZhong;
            asort($ziFuQuanZhongMap);
            // 将构造好的结点放到临时列表
            $tempJieDianMap['temp_'.$tempJieDianId] = $shangCengQuanZhong;
        }
    }

    /**
     * 获取二叉树
     * @return HaFuManShuJieDian
     */
    public function getHaFuManShu()
    {
        return $this->genJieDian;
    }

}

$string = 'abcdefg aabbccddeeffgg  abcd';
$haFuManShu = new HaFuManShu();
$haFuManShu->setMuBiaoZiFuChuan($string);
$haFuManShu->gouZaoHaFuManShu();
echo json_encode($haFuManShu->getHaFuManShu());
