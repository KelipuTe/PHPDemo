<?php

namespace App\ShuJuJieGou;


require_once 'ErChaShu.php';

/**
 * Class ErChaPaiXuShu [二叉排序树]
 * @package App\ShuJuJieGou
 */
class ErChaPaiXuShu extends ErChaShu
{
    /**
     * @var string [查询指针，记录遍历时指针最后所在的位置]
     */
    protected $chaXunZhiZhen;

    /**
     * ErChaPaiXuShu constructor.
     */
    public function __construct()
    {
        $this->xuNiNeiCunChuShiHua();
        $this->genJieDianZhiZhen = null;
        $this->chaXunZhiZhen = null;
    }

    public function zhongXuBianLiChaZhao($chaZhaoZhi)
    {
        $this->chaXunZhiZhen = null;
        return $this->zhongXuBianLiChaZhaoDiGui($this->genJieDianZhiZhen, $chaZhaoZhi);
    }

    /**
     * @param string $genJieDianZhiZhen
     * @param $chaZhaoZhi
     * @return string
     */
    protected function zhongXuBianLiChaZhaoDiGui($genJieDianZhiZhen, $chaZhaoZhi)
    {
        if ($genJieDianZhiZhen === null) {
            return false;
        }
        $genJieDian = $this->huoQuNeiCunShuJu($genJieDianZhiZhen);
        if ($genJieDian === null || $genJieDian->jieDianZhi === null) {
            return false;
        }
        $this->chaXunZhiZhen = $genJieDianZhiZhen;
        if ($genJieDian->jieDianZhi === $chaZhaoZhi) {
            return $genJieDianZhiZhen;
        } else if ($genJieDian->jieDianZhi > $chaZhaoZhi) {
            return $this->zhongXuBianLiChaZhaoDiGui($genJieDian->zuoZhiZhen, $chaZhaoZhi);
        } else if ($genJieDian->jieDianZhi < $chaZhaoZhi) {
            return $this->zhongXuBianLiChaZhaoDiGui($genJieDian->youZhiZhen, $chaZhaoZhi);
        } else {
            return false;
        }
    }

    public function chaRuJieDian($jieDianZhi)
    {
        if ($this->genJieDianZhiZhen === null) {
            $chaRuJieDianZhiZhen = $this->fenPeiXuNiNeiCun($jieDianZhi);
            $this->genJieDianZhiZhen = $chaRuJieDianZhiZhen;

            return;
        }
        // 重置查询指针的位置，用于插入结点
        $this->chaXunZhiZhen = null;
        $chaXunJieGuo = $this->zhongXuBianLiChaZhaoDiGui($this->genJieDianZhiZhen, $jieDianZhi);
        // 在递归查询之后，如果要插入的值已经存在，查询指针会指向查询到的结点
        // 如果要插入的值不存在，查询指针会指向最下层的结点，也就是将要插入节点的位置
        $chaXunJieDian = $this->huoQuNeiCunShuJu($this->chaXunZhiZhen);
        if ($chaXunJieGuo === false) {
            $chaRuJieDianZhiZhen = $this->fenPeiXuNiNeiCun($jieDianZhi);
            // 比较一下插入结点应该插到哪一边
            if ($chaXunJieDian->jieDianZhi > $jieDianZhi) {
                $chaXunJieDian->zuoZhiZhen = $chaRuJieDianZhiZhen;
            } else {
                $chaXunJieDian->youZhiZhen = $chaRuJieDianZhiZhen;
            }
        }
    }

    public function shanChuJieDian($jieDianZhi)
    {
        // 首先找到要删除的结点的位置
        $muBiaoZhiZhen = $this->zhongXuBianLiChaZhao($jieDianZhi);
        $muBiaoJieDian = $this->huoQuNeiCunShuJu($muBiaoZhiZhen);
        if ($muBiaoJieDian->zuoZhiZhen === null) {
            // 如果左子树为空，直接把右子树接上来
            $this->xuNiNeiCunKongJian[$muBiaoZhiZhen] = $this->huoQuNeiCunShuJu($muBiaoJieDian->youZhiZhen);
            $this->shiFangXuNiNeiCun($muBiaoJieDian->youZhiZhen);
        } else if ($muBiaoJieDian->youZhiZhen === null) {
            // 如果右子树为空，直接把左子树接上来
            $this->xuNiNeiCunKongJian[$muBiaoZhiZhen] = $this->huoQuNeiCunShuJu($muBiaoJieDian->zuoZhiZhen);
            $this->shiFangXuNiNeiCun($muBiaoJieDian->zuoZhiZhen);
        } else {
            // 如果左子树和右子树都存在
            // 这里的办法是从左子树中找到结点值最大的结点替代被删除的节点
            // 同理，从右子树中找到结点值最小的结点也是可行的
            $xiuGaiZhiZhen = $muBiaoZhiZhen;
            $xiuGaiJieDian = $muBiaoJieDian;
            // 记录结点值最大的结点的前驱结点
            $qianQuZhiZhen = $muBiaoZhiZhen;
            // 记录结点值最大的结点
            $xunZhiZhiZhen = $muBiaoJieDian->zuoZhiZhen;
            $xunZhiJieDian = $this->huoQuNeiCunShuJu($xunZhiZhiZhen);
            while ($xunZhiJieDian->youZhiZhen !== null) {
                $qianQuZhiZhen = $xunZhiZhiZhen;
                $xunZhiZhiZhen = $xunZhiJieDian->youZhiZhen;
                $xunZhiJieDian = $this->huoQuNeiCunShuJu($xunZhiZhiZhen);
            }
            // 直接把结点值最大的结点的结点值赋值到要删除的结点上，相当于一个替换的操作
            $xiuGaiJieDian->jieDianZhi = $xunZhiJieDian->jieDianZhi;
            $qianQuJieDian = $this->huoQuNeiCunShuJu($qianQuZhiZhen);
            if ($xiuGaiZhiZhen !== $qianQuZhiZhen) {
                $qianQuJieDian->youZhiZhen = $xunZhiJieDian->zuoZhiZhen;
            } else {
                $qianQuJieDian->zuoZhiZhen = $xunZhiJieDian->zuoZhiZhen;
            }
            // 释放掉结点值最大的结点，因为这个结点的值已经被记录到原先要删除的结点了
            $this->shiFangXuNiNeiCun($xunZhiZhiZhen);
        }
    }
}

/* 测试代码 */

// $erChaPaiXuShu = new ErChaPaiXuShu();
// $yuanSuBiao = [62, 58, 88, 47, 73, 99, 35, 51, 93, 37, 95];
// $yuanSuBiao = [162, 158, 188, 147, 173, 199, 135, 151, 129, 137, 195, 136, 149, 156, 148, 150, 138];
// foreach ($yuanSuBiao as $item) {
//     $erChaPaiXuShu->chaRuJieDian($item);
// }
// echo json_encode($erChaPaiXuShu->getErChaShu());
// echo json_encode($erChaPaiXuShu->zhongXuBianLi());
//
// $erChaPaiXuShu->shanChuJieDian(147);
// echo json_encode($erChaPaiXuShu->getErChaShu());