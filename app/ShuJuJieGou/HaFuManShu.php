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
     * 临时结点结点值，用于判断是不是有效结点
     */
    protected const TEMP_JIE_DIAN_ZHI = 'temp';

    /**
     * @var string [目标字符串]
     */
    protected $muBiaoZiFuZhuan;

    /**
     * @var array [字符权重列表]
     */
    protected $ziFuQuanZhongMap;

    /**
     * @var array [哈夫曼编码表]
     */
    protected $haFuManBianMaBiao;

    /**
     * @var HaFuManShuJieDian [根结点]
     */
    protected $genJieDian;

    /**
     * HaFuManShu constructor.
     * @param $string [目标字符串]
     */
    public function __construct($string = '')
    {
        $this->muBiaoZiFuZhuan = '';
        $this->ziFuQuanZhongMap = [];
        $this->haFuManBianMaBiao = [];
        $this->genJieDian = null;

        if (!empty($string)) {
            $this->setMuBiaoZiFuChuan($string);
        }
    }

    /**
     * 设置目标字符串并计算字符数目
     * @param string $string
     */
    public function setMuBiaoZiFuChuan($string)
    {
        if(empty($string)) return;
        $this->muBiaoZiFuZhuan = $string;
        $strLen = strlen($string);
        for ($i = 0; $i < $strLen; ++$i) {
            $char = $string[$i];
            // 转义一下特殊字符，用这些特殊字符作为数组键名，不合适。
            if ($char === ' ') $char = 'kong_ge';
            if (isset($this->ziFuQuanZhongMap[$char])) ++$this->ziFuQuanZhongMap[$char];
            else $this->ziFuQuanZhongMap[$char] = 1;
        }
        // 字符权重列表升序排序
        asort($this->ziFuQuanZhongMap);
        $this->gouZaoHaFuManShu();
        $this->gouZaoHaFuManBianMaBiao();
    }

    /**
     * 构造哈夫曼树
     */
    protected function gouZaoHaFuManShu()
    {
        $ziFuQuanZhongMap = $this->ziFuQuanZhongMap;
        $tempJieDianMap = [];
        $tempJieDianId = 1;
        while (count($ziFuQuanZhongMap) > 1) {
            // 这里获取两个结点的逻辑是一样的，但是不适合做成方法，涉及到数组的删除，有点得不偿失。
            // 获取第一个结点
            reset($ziFuQuanZhongMap);
            $keyZiFu1 = key($ziFuQuanZhongMap);
            $quanZhong1 = $ziFuQuanZhongMap[$keyZiFu1];
            if (isset($tempJieDianMap[$keyZiFu1])) {
                $treeNode1 = $tempJieDianMap[$keyZiFu1];
                unset($ziFuQuanZhongMap[$keyZiFu1]);
                unset($tempJieDianMap[$keyZiFu1]);
            } else {
                $treeNode1 = new HaFuManShuJieDian($keyZiFu1, $quanZhong1);
                unset($ziFuQuanZhongMap[$keyZiFu1]);
            }
            // 获取第二个结点
            // reset($ziFuQuanZhongMap);
            $keyZiFu2 = key($ziFuQuanZhongMap);
            $quanZhong2 = $ziFuQuanZhongMap[$keyZiFu2];
            if (isset($tempJieDianMap[$keyZiFu2])) {
                $treeNode2 = $tempJieDianMap[$keyZiFu2];
                unset($ziFuQuanZhongMap[$keyZiFu2]);
                unset($tempJieDianMap[$keyZiFu2]);
            } else {
                $treeNode2 = new HaFuManShuJieDian($keyZiFu2, $quanZhong2);
                unset($ziFuQuanZhongMap[$keyZiFu2]);
            }
            // 构造上层结点
            $shangCengQuanZhong = $treeNode1->quanZhong + $treeNode2->quanZhong;
            $shangCengTreeNode = new HaFuManShuJieDian(self::TEMP_JIE_DIAN_ZHI, $shangCengQuanZhong);
            if ($treeNode1->quanZhong <= $treeNode2->quanZhong) {
                $shangCengTreeNode->zuoZhiZhen = $treeNode1;
                $shangCengTreeNode->youZhiZhen = $treeNode2;
            } else {
                $shangCengTreeNode->zuoZhiZhen = $treeNode2;
                $shangCengTreeNode->youZhiZhen = $treeNode1;
            }
            // 将构造好的结点放回权重数组并升序排序
            $ziFuQuanZhongMap['temp_' . $tempJieDianId] = $shangCengQuanZhong;
            asort($ziFuQuanZhongMap);
            // 将构造好的结点放到临时列表
            $tempJieDianMap['temp_' . $tempJieDianId] = $shangCengTreeNode;
            // 临时结点ID自增
            ++$tempJieDianId;
        }
        $this->genJieDian = array_shift($tempJieDianMap);
    }

    /**
     * 获取哈夫曼树
     * @return HaFuManShuJieDian
     */
    public function getHaFuManShu()
    {
        return $this->genJieDian;
    }

    /**
     * 前序遍历构造哈夫曼编码表
     */
    protected function gouZaoHaFuManBianMaBiao()
    {
        $this->gouZaoHaFuManBianMaBiaoDiGui($this->genJieDian);
    }

    /**
     * @param ErChaShuJieDian $genJieDian
     */
    protected function gouZaoHaFuManBianMaBiaoDiGui($genJieDian, $qianZhui = '')
    {
        if ($genJieDian === null) return;
        if ($genJieDian->jieDianZhi === null) return;

        if ($genJieDian->jieDianZhi !== self::TEMP_JIE_DIAN_ZHI)
            $this->haFuManBianMaBiao[$genJieDian->jieDianZhi] = $qianZhui;
        $this->gouZaoHaFuManBianMaBiaoDiGui($genJieDian->zuoZhiZhen, $qianZhui . '0');
        $this->gouZaoHaFuManBianMaBiaoDiGui($genJieDian->youZhiZhen, $qianZhui . '1');
    }

    /**
     * 获取哈夫曼编码表
     * @return array
     */
    public function getHaFuManBianMaBiao()
    {
        return $this->haFuManBianMaBiao;
    }

    /**
     * 对字符串进行哈夫曼编码
     * @return string
     */
    public function ziFuChuanBianMa()
    {
        $bianMa = '';
        $strLen = strLen($this->muBiaoZiFuZhuan);
        for ($i = 0; $i < $strLen; ++$i) {
            $char = $this->muBiaoZiFuZhuan[$i];
            if ($char === ' ') $char = 'kong_ge';
            $bianMa .= $this->haFuManBianMaBiao[$char];
        }

        return $bianMa;
    }

    /**
     * 将哈夫曼编码进行解码
     * @param $bianMa [哈夫曼编码串]
     * @return string
     */
    public function ziFuChanJieMa($bianMa)
    {
        $haFuManJieMaBiao = array_flip($this->haFuManBianMaBiao);
        $jieMa = '';
        $shiBieMa = '';
        $strLen = strLen($bianMa);
        for ($i = 0; $i < $strLen; ++$i) {
            $shiBieMa .= $bianMa[$i];
            if (isset($haFuManJieMaBiao[$shiBieMa])) {
                if ($haFuManJieMaBiao[$shiBieMa] === 'kong_ge') $jieMa .= ' ';
                else $jieMa .= $haFuManJieMaBiao[$shiBieMa];
                $shiBieMa = '';
            }
        }
        return $jieMa;
    }
}

/* 测试代码 */

$string = 'hello world';
$haFuManShu = new HaFuManShu();
$haFuManShu->setMuBiaoZiFuChuan($string);
// echo json_encode($haFuManShu->getHaFuManShu());
// echo json_encode($haFuManShu->getHaFuManBianMaBiao());
$bianMa = $haFuManShu->ziFuChuanBianMa();
echo json_encode($bianMa);
echo json_encode($haFuManShu->ziFuChanJieMa($bianMa));
