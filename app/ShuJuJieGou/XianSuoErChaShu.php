<?php
/* 线索二叉树 */

namespace App\ShuJuJieGou;


require_once 'ErChaShu.php';
require_once 'XianSuoErChaShuJieDian.php';

/**
 * Class XianSuoErChaShu [线索二叉树]
 * @package App\ShuJuJieGou
 */
class XianSuoErChaShu extends ErChaShu
{
    /**
     * @var string [前驱结点指针]
     * 前驱结点需要额外记录，而后继结点不需要
     */
    protected $qianQuJieDianZhiZhen;

    /**
     * @var XianSuoErChaShuJieDian [前驱结点]
     * 前驱结点需要额外记录，而后继结点不需要
     */
    protected $qianQuJieDian;

    /**
     * XianSuoErChaShu constructor.
     * @param array $yuanSuBiao [二叉树元素表]
     * @throws \Exception
     */
    public function __construct($yuanSuBiao)
    {
        $this->qianQuJieDianZhiZhen = null;
        $this->qianQuJieDian = null;
        parent::__construct($yuanSuBiao);
    }

    /**
     * @param string $jieDianZhi
     * @return string
     */
    protected function fenPeiXuNiNeiCun($jieDianZhi)
    {
        $zhiZhen = 'zhi_zhen_' . $this->xuNiNeiCunDaXiao;
        ++$this->xuNiNeiCunDaXiao;
        $this->xuNiNeiCunKongJian[$zhiZhen] = new XianSuoErChaShuJieDian($jieDianZhi);

        return $zhiZhen;
    }

    protected function zhenLiXuNiNeiCunKongJian()
    {
        foreach ($this->xuNiNeiCunKongJian as $key => $value) {
            if ($value->jieDianZhi === '') {
                unset($this->xuNiNeiCunKongJian[$key]);
            }
        }
    }

    /**
     * 获取二叉树
     * @return array
     */
    public function getErChaShu()
    {
        return [
            'genJieDianZhiZhen' => $this->genJieDianZhiZhen,
            'xuNiNeiCunKongJian' => $this->xuNiNeiCunKongJian
        ];
    }

    /**
     * 以层次遍历的顺序依次插入结点
     * @param string $jieDianZhiZhen
     * @throws \Exception
     */
    protected function yiCiChaRuJieDian($jieDianZhiZhen)
    {
        // 初始化一个队列
        $duiLie = [];
        // 根结点入队
        array_unshift($duiLie, $this->genJieDianZhiZhen);
        while (!empty($duiLie)) {
            // 持续遍历，直到队列为空
            // 队列元素出队
            $tempJieDianZhiZhen = array_pop($duiLie);
            if ($tempJieDianZhiZhen === null) {
                throw new \Exception("指针：({$tempJieDianZhiZhen})为空");
            }
            $tempJieDian = $this->huoQuNeiCunShuJu($tempJieDianZhiZhen);
            if ($tempJieDian === null) {
                throw new \Exception("结点：({$tempJieDianZhiZhen})为空");
            }
            if ($tempJieDian->zuoZhiZhen === null) {
                // 如果左指针为空就插入结点
                $tempJieDian->zuoZhiZhen = $jieDianZhiZhen;
                $tempJieDian->zuoBiaoShi = 1;

                return;
            } else {
                // 如果左指针不为空，则左结点先入队
                array_unshift($duiLie, $tempJieDian->zuoZhiZhen);
            }
            if ($tempJieDian->youZhiZhen === null) {
                // 如果右指针为空就插入结点
                $tempJieDian->youZhiZhen = $jieDianZhiZhen;
                $tempJieDian->youBiaoShi = 1;

                return;
            } else {
                // 如果右指针不为空，则右结点后入队
                array_unshift($duiLie, $tempJieDian->youZhiZhen);
            }
        }
    }

    protected function qianXuBianLiXiuJianDiGui($genJieDianZhiZhen)
    {
        if ($genJieDianZhiZhen === null) {
            return;
        }
        $genJieDian = $this->huoQuNeiCunShuJu($genJieDianZhiZhen);
        if ($genJieDian === null || $genJieDian->jieDianZhi === null) {
            return;
        }
        if ($genJieDian->zuoZhiZhen !== null) {
            $zuoJieDian = $this->huoQuNeiCunShuJu($genJieDian->zuoZhiZhen);
            if ($zuoJieDian->jieDianZhi === '') {
                $genJieDian->zuoZhiZhen = null;
                $genJieDian->zuoBiaoShi = -1;
            } else {
                $this->qianXuBianLiXiuJianDiGui($genJieDian->zuoZhiZhen);
            }
        }
        if ($genJieDian->youZhiZhen !== null) {
            $youJieDian = $this->huoQuNeiCunShuJu($genJieDian->youZhiZhen);
            if ($youJieDian->jieDianZhi === '') {
                $genJieDian->youZhiZhen = null;
                $genJieDian->youBiaoShi = -1;
            } else {
                $this->qianXuBianLiXiuJianDiGui($genJieDian->youZhiZhen);
            }
        }
    }

    protected function zhongXuBianLiDiGui($genJieDianZhiZhen)
    {
        if ($genJieDianZhiZhen === null) {
            return '';
        }
        $genJieDian = $this->huoQuNeiCunShuJu($genJieDianZhiZhen);
        if ($genJieDian === null || $genJieDian->jieDianZhi === null) {
            return '';
        }
        $xuLie = '';
        if ($genJieDian->zuoBiaoShi === 1) {
            $xuLie .= $this->zhongXuBianLiDiGui($genJieDian->zuoZhiZhen);
        }
        $xuLie .= $genJieDian->jieDianZhi . ';';
        if ($genJieDian->youBiaoShi === 1) {
            $xuLie .= $this->zhongXuBianLiDiGui($genJieDian->youZhiZhen);
        }

        return $xuLie;
    }

    /**
     * 中序遍历线索化
     */
    public function zhongXuBianLiXianSuoHua()
    {
        $this->qianQuJieDianZhiZhen = null;
        $this->zhongXuBianLiXianSuoHuaDiGui($this->genJieDianZhiZhen);
    }

    /**
     * 中序遍历线索化
     * @param string $genJieDianZhiZhen
     */
    protected function zhongXuBianLiXianSuoHuaDiGui($genJieDianZhiZhen)
    {
        if ($genJieDianZhiZhen === null) {
            return;
        }
        $genJieDian = $this->huoQuNeiCunShuJu($genJieDianZhiZhen);
        if ($genJieDian === null || $genJieDian->jieDianZhi === null) {
            return;
        }
        if ($genJieDian->zuoBiaoShi === 1) {
            // 有左孩子
            $this->zhongXuBianLiXianSuoHuaDiGui($genJieDian->zuoZhiZhen);
        }
        if ($this->qianQuJieDianZhiZhen !== null && $genJieDian->zuoBiaoShi === -1) {
            // 设置前驱线索
            $genJieDian->zuoBiaoShi = 0;
            $genJieDian->zuoZhiZhen = $this->qianQuJieDianZhiZhen;
        }
        if ($this->qianQuJieDian !== null && $this->qianQuJieDian->youBiaoShi === -1) {
            // 设置后继线索
            $this->qianQuJieDian->youBiaoShi = 0;
            $this->qianQuJieDian->youZhiZhen = $genJieDianZhiZhen;
        }
        // 登记自己为前驱
        $this->qianQuJieDianZhiZhen = $genJieDianZhiZhen;
        $this->qianQuJieDian = $genJieDian;

        if ($genJieDian->youBiaoShi === 1) {
            // 有右孩子
            $this->zhongXuBianLiXianSuoHuaDiGui($genJieDian->youZhiZhen);
        }
    }
}

/* 测试代码 */


// $yuanSuBiao = ['V0', 'V1', 'V2', null, 'V4', null, 'V6', null, null, 'V9', 'V10', null, null, 'V13', null];
// $xianSuoErChaShu = new XianSuoErChaShu($yuanSuBiao);
// $xianSuoErChaShu->zhongXuBianLiXianSuoHua();
// echo json_encode($xianSuoErChaShu->getErChaShu());
// echo json_encode($xianSuoErChaShu->zhongXuBianLi());
