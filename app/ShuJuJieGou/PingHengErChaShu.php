<?php

namespace App\ShuJuJieGou;


require_once 'ErChaPaiXuShu.php';
require_once 'PingHengErChaShuJieDian.php';

/**
 * Class PingHengErChaShu [平衡二叉树]
 * @package App\ShuJuJieGou
 */
class PingHengErChaShu extends ErChaPaiXuShu
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $jieDianZhi
     * @return string
     */
    protected function fenPeiXuNiNeiCun($jieDianZhi)
    {
        $zhiZhen = 'zhi_zhen_' . $this->xuNiNeiCunDaXiao;
        ++$this->xuNiNeiCunDaXiao;
        $this->xuNiNeiCunKongJian[$zhiZhen] = new PingHengErChaShuJieDian($jieDianZhi);

        return $zhiZhen;
    }

    public function chaRuJieDian($jieDianZhi)
    {
        if ($this->genJieDianZhiZhen === null) {
            $chaRuJieDianZhiZhen = $this->fenPeiXuNiNeiCun($jieDianZhi);
            $chaRuJieDian = $this->huoQuNeiCunShuJu($chaRuJieDianZhiZhen);
            $chaRuJieDian->jieDianShenDu = 0;
            $this->genJieDianZhiZhen = $chaRuJieDianZhiZhen;

            return;
        }
        $this->chaRuJieDianDiGui($this->genJieDianZhiZhen, $jieDianZhi);
    }

    public function chaRuJieDianDiGui($genJieDianZhiZhen, $jieDianZhi)
    {
        // 插入结点
        $genJieDian = $this->huoQuNeiCunShuJu($genJieDianZhiZhen);
        if ($genJieDian->jieDianZhi > $jieDianZhi) {
            if ($genJieDian->zuoZhiZhen !== null) {
                $this->chaRuJieDianDiGui($genJieDian->zuoZhiZhen, $jieDianZhi);
            } else {
                $chaRuJieDianZhiShen = $this->fenPeiXuNiNeiCun($jieDianZhi);
                $chaRuJieDian = $this->huoQuNeiCunShuJu($chaRuJieDianZhiShen);
                $chaRuJieDian->fuZhiZhen = $genJieDianZhiZhen;
                $genJieDian->zuoZhiZhen = $chaRuJieDianZhiShen;
            }
        } else {
            if ($genJieDian->youZhiZhen !== null) {
                $this->chaRuJieDianDiGui($genJieDian->youZhiZhen, $jieDianZhi);
            } else {
                $chaRuJieDianZhiShen = $this->fenPeiXuNiNeiCun($jieDianZhi);
                $chaRuJieDian = $this->huoQuNeiCunShuJu($chaRuJieDianZhiShen);
                $chaRuJieDian->fuZhiZhen = $genJieDianZhiZhen;
                $genJieDian->youZhiZhen = $chaRuJieDianZhiShen;
            }
        }
        // 计算平衡参数，检查是否需要旋转树
        $genJieDian->pingHengCanShu = $this->jiSuanPingHengCanShu($genJieDianZhiZhen);
        if ($genJieDian->pingHengCanShu > 1) {
            // 左子树高，LL型
            $zuoJieDian = $this->huoQuNeiCunShuJu($genJieDian->zuoZhiZhen);
            if ($zuoJieDian->pingHengCanShu === -1) {
                // 左子树的右子树高，LR型
                $this->zuoXuan($genJieDian->zuoZhiZhen);
            }
            $this->youXuan($genJieDianZhiZhen);
        }
        if ($genJieDian->pingHengCanShu < -1) {
            // 右子树高，RR型
            $youJieDian = $this->huoQuNeiCunShuJu($genJieDian->youZhiZhen);
            if ($youJieDian->pingHengCanShu === 1) {
                // 右子树的左子树高，RL型
                $this->youXuan($genJieDian->youZhiZhen);
            }
            $this->zuoXuan($genJieDianZhiZhen);
        }
        // 计算树深度和平衡参数
        $genJieDian->jieDianShenDu = $this->jiSuanShenDu($genJieDianZhiZhen);
        $genJieDian->pingHengCanShu = $this->jiSuanPingHengCanShu($genJieDianZhiZhen);
    }

    protected function jiSuanShenDu($jieDianZhiZhen)
    {
        $zuoShenDu = 0;
        $youShenDu = 0;
        $jieDian = $this->huoQuNeiCunShuJu($jieDianZhiZhen);
        if ($jieDian->zuoZhiZhen !== null) {
            $zuoJieDian = $this->huoQuNeiCunShuJu($jieDian->zuoZhiZhen);
            $zuoShenDu = $zuoJieDian->jieDianShenDu;
        }
        if ($jieDian->youZhiZhen !== null) {
            $youJieDian = $this->huoQuNeiCunShuJu($jieDian->youZhiZhen);
            $youShenDu = $youJieDian->jieDianShenDu;
        }

        return max($zuoShenDu, $youShenDu) + 1;
    }

    protected function jiSuanPingHengCanShu($jieDianZhiZhen)
    {
        $zuoShenDu = -1;
        $youShenDu = -1;
        $jieDian = $this->huoQuNeiCunShuJu($jieDianZhiZhen);
        if ($jieDian->zuoZhiZhen !== null) {
            $zuoJieDian = $this->huoQuNeiCunShuJu($jieDian->zuoZhiZhen);
            $zuoShenDu = $zuoJieDian->jieDianShenDu;
        }
        if ($jieDian->youZhiZhen !== null) {
            $youJieDian = $this->huoQuNeiCunShuJu($jieDian->youZhiZhen);
            $youShenDu = $youJieDian->jieDianShenDu;
        }

        return $zuoShenDu - $youShenDu;
    }

    public function zuoXuan($jieDianZhiZhen)
    {
        $jieDian = $this->huoQuNeiCunShuJu($jieDianZhiZhen);
        $fuJieDian = $this->huoQuNeiCunShuJu($jieDian->fuZhiZhen);
        $youJieDianZhiZhen = $jieDian->youZhiZhen;
        $youJieDian = $this->huoQuNeiCunShuJu($youJieDianZhiZhen);
        $youJieDianZuoJieDianZhiZhen = $youJieDian->zuoZhiZhen;
        $youJieDianZuoJieDian = $this->huoQuNeiCunShuJu($youJieDianZuoJieDianZhiZhen);
        // 右孩子变成父结点
        if ($this->genJieDianZhiZhen === $jieDianZhiZhen) {
            // 如果旋转的是根结点
            $this->genJieDianZhiZhen = $jieDian->youZhiZhen;
        }
        $youJieDian->fuZhiZhen = $jieDian->fuZhiZhen;
        $youJieDian->zuoZhiZhen = $jieDianZhiZhen;
        $jieDian->fuZhiZhen = $jieDian->youZhiZhen;
        if ($fuJieDian !== null) {
            // 如果旋转的结点有父结点，则要把左旋上去的结点接到父结点相应的位置
            if ($jieDianZhiZhen === $fuJieDian->youZhiZhen) {
                $fuJieDian->youZhiZhen = $jieDian->youZhiZhen;
            } else if ($jieDianZhiZhen === $fuJieDian->zuoZhiZhen) {
                $fuJieDian->zuoZhiZhen = $jieDian->youZhiZhen;
            }
        }
        // 如果右孩子有左孩子，则把这个左孩子变成自己的右孩子
        $jieDian->youZhiZhen = $youJieDianZuoJieDianZhiZhen;
        if ($youJieDianZuoJieDianZhiZhen !== null) {
            $youJieDianZuoJieDian->fuZhiZhen = $jieDianZhiZhen;
        }
        // 重新计算深度和平衡参数
        $jieDian->jieDianShenDu = $this->jiSuanShenDu($jieDianZhiZhen);
        $jieDian->pingHengCanShu = $this->jiSuanPingHengCanShu($jieDianZhiZhen);
        $youJieDian->jieDianShenDu = $this->jiSuanShenDu($youJieDianZhiZhen);
        $youJieDian->pingHengCanShu = $this->jiSuanPingHengCanShu($youJieDianZhiZhen);
    }

    public function youXuan($jieDianZhiZhen)
    {
        $jieDian = $this->huoQuNeiCunShuJu($jieDianZhiZhen);
        $fuJieDian = $this->huoQuNeiCunShuJu($jieDian->fuZhiZhen);
        $zuoJieDianZhiZhen = $jieDian->zuoZhiZhen;
        $zuoJieDian = $this->huoQuNeiCunShuJu($zuoJieDianZhiZhen);
        $zuoJieDianYouJieDianZhiZhen = $zuoJieDian->youZhiZhen;
        $zuoJieDianYouJieDian = $this->huoQuNeiCunShuJu($zuoJieDianYouJieDianZhiZhen);
        // 左孩子变成父节点
        if ($this->genJieDianZhiZhen === $jieDianZhiZhen) {
            // 如果旋转的是根结点
            $this->genJieDianZhiZhen = $jieDian->zuoZhiZhen;
        }
        $zuoJieDian->fuZhiZhen = $jieDian->fuZhiZhen;
        $zuoJieDian->youZhiZhen = $jieDianZhiZhen;
        $jieDian->fuZhiZhen = $jieDian->zuoZhiZhen;
        if ($fuJieDian !== null) {
            // 如果旋转的结点有父结点，则要把右旋上去的结点接到父结点相应的位置
            if ($jieDianZhiZhen === $fuJieDian->zuoZhiZhen) {
                $fuJieDian->zuoZhiZhen = $jieDian->zuoZhiZhen;
            } else if ($jieDianZhiZhen === $fuJieDian->youZhiZhen) {
                $fuJieDian->youZhiZhen = $jieDian->zuoZhiZhen;
            }
        }
        // 如果左孩子有右孩子，则把这个右孩子变成自己的左孩子
        $jieDian->zuoZhiZhen = $zuoJieDianYouJieDianZhiZhen;
        if ($zuoJieDianYouJieDianZhiZhen !== null) {
            $zuoJieDianYouJieDian->fuZhiZhen = $jieDianZhiZhen;
        }
        // 重新计算深度和平衡参数
        $jieDian->jieDianShenDu = $this->jiSuanShenDu($jieDianZhiZhen);
        $jieDian->pingHengCanShu = $this->jiSuanPingHengCanShu($jieDianZhiZhen);
        $zuoJieDian->jieDianShenDu = $this->jiSuanShenDu($zuoJieDianZhiZhen);
        $zuoJieDian->pingHengCanShu = $this->jiSuanPingHengCanShu($zuoJieDianZhiZhen);
    }
}

/* 测试代码 */

// $erChaPaiXuShu = new PingHengErChaShu();
// $yuanSuBiao = [60, 50, 40];
// $yuanSuBiao = [40, 50, 60];
// $yuanSuBiao = [50, 70, 60];
// $yuanSuBiao = [70, 50, 60];
// foreach ($yuanSuBiao as $item) {
//     $erChaPaiXuShu->chaRuJieDian($item);
// }
// echo json_encode($erChaPaiXuShu->getErChaShu());
