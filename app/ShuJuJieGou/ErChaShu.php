<?php

namespace App\ShuJuJieGou;


require_once 'XuNiNeiCunTrait.php';
require_once 'ErChaShuJieDian.php';

/**
 * Class ErChaShu [二叉树]
 * @package App\ShuJuJieGou
 */
class ErChaShu
{
    use XuNiNeiCunTrait;

    /**
     * @var array [二叉树元素表]
     */
    protected $yuanSuBiao;

    /**
     * @var string [根结点指针]
     */
    protected $genJieDianZhiZhen;

    /**
     * ErChaShu constructor.
     * @param array $yuanSuBiao [二叉树元素表]
     * @throws \Exception
     */
    public function __construct($yuanSuBiao)
    {
        $this->xuNiNeiCunChuShiHua();
        $this->yuanSuBiao = [];
        $this->genJieDianZhiZhen = null;
        if (is_array($yuanSuBiao) && count($yuanSuBiao) > 0) {
            $this->yuanSuBiao = $yuanSuBiao;
            $this->gouZaoErChaShu();
            $this->qianXuBianLiXiuJian();
            $this->zhenLiXuNiNeiCunKongJian();
        }
    }

    /**
     * @param string $jieDianZhi
     * @return string
     */
    protected function fenPeiXuNiNeiCun($jieDianZhi)
    {
        $zhiZhen = 'zhi_zhen_' . $this->xuNiNeiCunDaXiao;
        ++$this->xuNiNeiCunDaXiao;
        $this->xuNiNeiCunKongJian[$zhiZhen] = new ErChaShuJieDian($jieDianZhi);

        return $zhiZhen;
    }

    protected function zhenLiXuNiNeiCunKongJian()
    {
        foreach ($this->xuNiNeiCunKongJian as $key => $value) {
            if ($value->jieDianZhi === '') {
                $this->shiFangXuNiNeiCun($key);
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
     * 用二叉树元素表构造二叉树
     * @throws \Exception
     */
    protected function gouZaoErChaShu()
    {
        if (count($this->yuanSuBiao) < 1) {
            return;
        }
        // 创建根结点
        $this->genJieDianZhiZhen = $this->fenPeiXuNiNeiCun($this->yuanSuBiao[0]);
        $biaoChang = count($this->yuanSuBiao);
        for ($i = 1; $i < $biaoChang; $i++) {
            // 依次添加结点
            $jieDianZhiZhen = $this->fenPeiXuNiNeiCun($this->yuanSuBiao[$i]);
            $this->yiCiChaRuJieDian($jieDianZhiZhen);
        }
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

                return;
            } else {
                // 如果左指针不为空，则左结点先入队
                array_unshift($duiLie, $tempJieDian->zuoZhiZhen);
            }
            if ($tempJieDian->youZhiZhen === null) {
                // 如果右指针为空就插入结点
                $tempJieDian->youZhiZhen = $jieDianZhiZhen;

                return;
            } else {
                // 如果右指针不为空，则右结点后入队
                array_unshift($duiLie, $tempJieDian->youZhiZhen);
            }
        }
    }

    /**
     * 使用前序遍历修剪多余的空结点
     */
    protected function qianXuBianLiXiuJian()
    {
        $this->qianXuBianLiXiuJianDiGui($this->genJieDianZhiZhen);
    }

    /**
     * @param string $genJieDianZhiZhen
     */
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
            } else {
                $this->qianXuBianLiXiuJianDiGui($genJieDian->zuoZhiZhen);
            }
        }
        if ($genJieDian->youZhiZhen !== null) {
            $youJieDian = $this->huoQuNeiCunShuJu($genJieDian->youZhiZhen);
            if ($youJieDian->jieDianZhi === '') {
                $genJieDian->youZhiZhen = null;
            } else {
                $this->qianXuBianLiXiuJianDiGui($genJieDian->youZhiZhen);
            }
        }
    }

    /**
     * 前序遍历
     */
    public function qianXuBianLi()
    {
        return $this->qianXuBianLiDiGui($this->genJieDianZhiZhen);
    }

    /**
     * @param string $genJieDianZhiZhen
     * @return string
     */
    protected function qianXuBianLiDiGui($genJieDianZhiZhen)
    {
        if ($genJieDianZhiZhen === null) {
            return '';
        }
        $genJieDian = $this->huoQuNeiCunShuJu($genJieDianZhiZhen);
        if ($genJieDian === null || $genJieDian->jieDianZhi === null) {
            return '';
        }
        $xuLie = '';
        $xuLie .= $genJieDian->jieDianZhi . ';';
        $xuLie .= $this->qianXuBianLiDiGui($genJieDian->zuoZhiZhen);
        $xuLie .= $this->qianXuBianLiDiGui($genJieDian->youZhiZhen);

        return $xuLie;
    }

    /**
     * 中序遍历
     * @return string
     */
    public function zhongXuBianLi()
    {
        return $this->zhongXuBianLiDiGui($this->genJieDianZhiZhen);
    }

    /**
     * @param string $genJieDianZhiZhen
     * @return string
     */
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
        $xuLie .= $this->zhongXuBianLiDiGui($genJieDian->zuoZhiZhen);
        $xuLie .= $genJieDian->jieDianZhi . ';';
        $xuLie .= $this->zhongXuBianLiDiGui($genJieDian->youZhiZhen);

        return $xuLie;
    }

    /**
     * 后序遍历
     */
    public function houXuBianLi()
    {
        return $this->houXuBianLiDiGui($this->genJieDianZhiZhen);
    }

    /**
     * @param string $genJieDianZhiZhen
     * @return string
     */
    protected function houXuBianLiDiGui($genJieDianZhiZhen)
    {
        if ($genJieDianZhiZhen === null) {
            return '';
        }
        $genJieDian = $this->huoQuNeiCunShuJu($genJieDianZhiZhen);
        if ($genJieDian === null || $genJieDian->jieDianZhi === null) {
            return '';
        }
        $xuLie = '';
        $xuLie .= $this->houXuBianLiDiGui($genJieDian->zuoZhiZhen);
        $xuLie .= $this->houXuBianLiDiGui($genJieDian->youZhiZhen);
        $xuLie .= $genJieDian->jieDianZhi . ';';

        return $xuLie;
    }

    /**
     * 计算二叉树的最大深度
     * @return int
     */
    public function jiSuanZuiDaShenDu()
    {
        return $this->jiSuanZuiDaShenDuDiGui($this->genJieDianZhiZhen);
    }

    /**
     * @param string $genJieDianZhiZhen
     * @return int
     */
    protected function jiSuanZuiDaShenDuDiGui($genJieDianZhiZhen)
    {
        if ($genJieDianZhiZhen === null) {
            return 0;
        }
        $genJieDian = $this->huoQuNeiCunShuJu($genJieDianZhiZhen);
        if ($genJieDian === null || $genJieDian->jieDianZhi === null) {
            return 0;
        }
        $zuoZiShuShenDu = $this->jiSuanZuiDaShenDuDiGui($genJieDian->zuoZhiZhen);
        $youZiShuShenDu = $this->jiSuanZuiDaShenDuDiGui($genJieDian->youZhiZhen);

        return max($zuoZiShuShenDu, $youZiShuShenDu) + 1;
    }

    /**
     * 深度优先遍历
     * @return array
     */
    public function shenDuYouXianBianLi()
    {
        $xuLie = [];
        $zhan = [];
        // 根结点入栈
        array_push($zhan, $this->genJieDianZhiZhen);
        while (!empty($zhan)) {
            // 持续遍历，直到栈为空
            // 栈顶元素出栈
            $tempJieDianZhiZhen = array_pop($zhan);
            if ($tempJieDianZhiZhen === null) {
                continue;
            }
            $tempJieDian = $this->huoQuNeiCunShuJu($tempJieDianZhiZhen);
            if ($tempJieDian === null) {
                continue;
            }
            if ($tempJieDian->jieDianZhi !== null) {
                // 存放结点数据
                $xuLie[] = $tempJieDian->jieDianZhi;
            }
            if ($tempJieDian->youZhiZhen !== null) {
                // 右结点先入栈，后遍历
                array_push($zhan, $tempJieDian->youZhiZhen);
            }
            if ($tempJieDian->zuoZhiZhen !== null) {
                // 左结点后入栈，先遍历
                array_push($zhan, $tempJieDian->zuoZhiZhen);
            }
        }

        return $xuLie;
    }

    /**
     * 广度优先遍历
     * @return array
     */
    public function guangDuYouXianBianLi()
    {
        $xuLie = [];
        $duiLie = [];
        array_unshift($duiLie, $this->genJieDianZhiZhen);
        while (!empty($duiLie)) {
            $tempJieDianZhiZhen = array_pop($duiLie);
            if ($tempJieDianZhiZhen === null) {
                continue;
            }
            $tempJieDian = $this->huoQuNeiCunShuJu($tempJieDianZhiZhen);
            if ($tempJieDian === null) {
                continue;
            }
            if ($tempJieDian->jieDianZhi !== null) {
                // 存放结点数据
                $xuLie[] = $tempJieDian->jieDianZhi;
            }
            if ($tempJieDian->zuoZhiZhen !== null) {
                // 左结点先入队，先遍历
                array_unshift($duiLie, $tempJieDian->zuoZhiZhen);
            }
            if ($tempJieDian->youZhiZhen !== null) {
                // 右结点后入队，后遍历
                array_unshift($duiLie, $tempJieDian->youZhiZhen);
            }
        }

        return $xuLie;
    }

    /**
     * 广度优先遍历，可分层输出结果
     * @return array
     */
    public function guangDuYouXianBianLiFenCeng()
    {
        $xuLie = [];
        $cengShu = 1;
        $duiLie = [];
        array_unshift($duiLie, $this->genJieDianZhiZhen);
        while (!empty($duiLie)) {
            $length = count($duiLie);
            for ($i = 0; $i < $length; $i++) {
                $tempJieDianZhiZhen = array_pop($duiLie);
                if ($tempJieDianZhiZhen === null) {
                    continue;
                }
                $tempJieDian = $this->huoQuNeiCunShuJu($tempJieDianZhiZhen);
                if ($tempJieDian === null) {
                    continue;
                }
                if ($tempJieDian->jieDianZhi !== null) {
                    $xuLie[$cengShu][] = $tempJieDian->jieDianZhi;
                }
                if ($tempJieDian->zuoZhiZhen !== null) {
                    array_unshift($duiLie, $tempJieDian->zuoZhiZhen);
                }
                if ($tempJieDian->youZhiZhen !== null) {
                    array_unshift($duiLie, $tempJieDian->youZhiZhen);
                }
            }
            // 一层遍历结束，层数+1
            $cengShu++;
        }

        return $xuLie;
    }
}

/* 测试代码 */

// $yuanSuBiao = ['V0', 'V1', 'V2', null, 'V4', null, 'V6', null, null, 'V9', 'V10', null, null, 'V13', null];
// $erChaShu = new ErChaShu($yuanSuBiao);
// echo json_encode($erChaShu->getErChaShu());
// echo json_encode($erChaShu->qianXuBianLi());
// echo json_encode($erChaShu->zhongXuBianLi());
// echo json_encode($erChaShu->houXuBianLi());
// echo json_encode($erChaShu->jiSuanZuiDaShenDu());
// echo json_encode($erChaShu->guangDuYouXianBianLi());
// echo json_encode($erChaShu->guangDuYouXianBianLiFenCeng());
// echo json_encode($erChaShu->shenDuYouXianBianLi());
