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
        $this->chaXunZhiZhen = null;
        $chaXunJieGuo = $this->zhongXuBianLiChaZhaoDiGui($this->genJieDianZhiZhen, $jieDianZhi);
        if ($chaXunJieGuo === false) {
            $chaRuJieDianZhiZhen = $this->fenPeiXuNiNeiCun($jieDianZhi);
            $chaRuJieDian = $this->huoQuNeiCunShuJu($this->chaXunZhiZhen);
            if ($chaRuJieDian->jieDianZhi > $jieDianZhi) {
                $chaRuJieDian->zuoZhiZhen = $chaRuJieDianZhiZhen;
            } else {
                $chaRuJieDian->youZhiZhen = $chaRuJieDianZhiZhen;
            }
        }
    }

    public function shanChuJieDian($jieDianZhi)
    {
        $muBiaoZhiZhen = $this->zhongXuBianLiChaZhao($jieDianZhi);
        $muBiaoJieDian = $this->huoQuNeiCunShuJu($muBiaoZhiZhen);
        if ($muBiaoJieDian->zuoZhiZhen === null) {
            $this->xuNiNeiCunKongJian[$muBiaoZhiZhen] = $this->huoQuNeiCunShuJu($muBiaoJieDian->youZhiZhen);
            $this->shiFangXuNiNeiCun($muBiaoJieDian->youZhiZhen);
        } else if ($muBiaoJieDian->youZhiZhen === null) {
            $this->xuNiNeiCunKongJian[$muBiaoZhiZhen] = $this->huoQuNeiCunShuJu($muBiaoJieDian->zuoZhiZhen);
            $this->shiFangXuNiNeiCun($muBiaoJieDian->zuoZhiZhen);
        } else {
            $xiuGaiZhiZhen = $muBiaoZhiZhen;
            $xiuGaiJieDian = $muBiaoJieDian;
            $qianQuZhiZhen = $muBiaoZhiZhen;
            $xunZhiZhiZhen = $muBiaoJieDian->zuoZhiZhen;
            $xunZhiJieDian = $this->huoQuNeiCunShuJu($xunZhiZhiZhen);
            while ($xunZhiJieDian->youZhiZhen !== null) {
                $qianQuZhiZhen = $xunZhiZhiZhen;
                $xunZhiZhiZhen = $xunZhiJieDian->youZhiZhen;
                $xunZhiJieDian = $this->huoQuNeiCunShuJu($xunZhiZhiZhen);
            }
            $xiuGaiJieDian->jieDianZhi = $xunZhiJieDian->jieDianZhi;
            $qianQuJieDian = $this->huoQuNeiCunShuJu($qianQuZhiZhen);
            if ($xiuGaiZhiZhen !== $qianQuZhiZhen) {
                $qianQuJieDian->yuoZhiZhen = $xunZhiJieDian->zuoZhiZhen;
            } else {
                $qianQuJieDian->zuoZhiZhen = $xunZhiJieDian->zuoZhiZhen;
            }
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

// $erChaPaiXuShu->shanChuJieDian(147);
// echo json_encode($erChaPaiXuShu->getErChaShu());