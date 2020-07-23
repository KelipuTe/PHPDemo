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
            $this->genJieDianZhiZhen = $chaRuJieDianZhiZhen;
            return;
        }
        $this->chaXunZhiZhen = null;
        $chaXunJieGuo = $this->zhongXuBianLiChaZhaoDiGui($this->genJieDianZhiZhen, $jieDianZhi);
        $chaXunJieDian = $this->huoQuNeiCunShuJu($this->chaXunZhiZhen);
        if ($chaXunJieGuo === false) {
            $chaRuJieDianZhiZhen = $this->fenPeiXuNiNeiCun($jieDianZhi);
            $chaRuJieDian = $this->huoQuNeiCunShuJu($chaRuJieDianZhiZhen);
            if ($chaRuJieDian->jieDianZhi > $jieDianZhi) {
                $chaRuJieDian->zuoZhiZhen = $chaRuJieDianZhiZhen;
                $chaRuJieDian->fuZhiZhen = $this->chaXunZhiZhen;
            } else {
                $chaRuJieDian->youZhiZhen = $chaRuJieDianZhiZhen;
                $chaRuJieDian->fuZhiZhen = $this->chaXunZhiZhen;
            }
        }
        $chaXunJieDian->jieDianShenDu = $this->jiSuanShenDu($this->chaXunZhiZhen);
    }

    protected function jiSuanShenDu($jieDianZhiZhen)
    {
        $jieDianShenDu = 0;
        $jieDian = $this->huoQuNeiCunShuJu($jieDianZhiZhen);
        if ($jieDian->zuoZhiZhen !== null) {
            $zuoJieDian = $this->huoQuNeiCunShuJu($jieDian->zuoZhiZhen);
            $jieDianShenDu = $zuoJieDian->jieDianShenDu;
        }
        if ($jieDian->youZhiZhen !== null) {
            $youJieDian = $this->huoQuNeiCunShuJu($jieDian->youZhiZhen);
            $jieDianShenDu = $youJieDian->jieDianShenDu;
        }
        ++$jieDianShenDu;

        return $jieDianShenDu;
    }
}

$queryData = [
    'user_id'                   => 123456,
    'exclude_cohosted_listings' => 'true',
    '_limit'                    => 50,
    '_offset'                   => 0,
];

echo http_build_query($queryData);

// $erChaPaiXuShu = new PingHengErChaShu();
// $yuanSuBiao = [50, 45, 44];
// foreach ($yuanSuBiao as $item) {
//     $erChaPaiXuShu->chaRuJieDian($item);
// }
// echo json_encode($erChaPaiXuShu->getErChaShu());

// $erChaPaiXuShu->shanChuJieDian(147);
// echo json_encode($erChaPaiXuShu->getErChaShu());