<?php

namespace App\ShuJuJieGou;


require_once 'LinJieBiaoJieDian.php';

/**
 * Class WuXiangTuLinJieBiao [无向图，邻接表]
 * @package App\ShuJuJieGou
 */
class WuXiangTuLinJieBiao
{
    /**
     * @var array [路径列表]
     */
    protected $luJingLieBiao;

    /**
     * @var array [顶点列表]
     * 顶点列表采用key=>value的形式，key表示顶点，value表示坐标（矩阵坐标）
     */
    protected $dingDianLieBiao;

    /**
     * @var int [顶点数]
     */
    protected $dingDianShu;

    /**
     * @var array [坐标列表]
     * 坐标列表保存坐标和顶点的对应关系
     */
    protected $zuoBiaoLieBiao;

    /**
     * @var array [邻接表]
     */
    protected $linJieBiao;

    /**
     * @var array [顶点访问列表]
     * 图遍历时保存顶点访问状态
     */
    protected $dingDianFangWenLieBiao;

    /**
     * @var string [遍历结果]
     * 图遍历时保存遍历结果
     */
    protected $bianLiJieGuo;

    /**
     * WuXiangTuLinJieBiao constructor.
     * @param array $luJingLieBiao
     */
    public function __construct($luJingLieBiao = [])
    {
        $this->luJingLieBiao = [];
        $this->dingDianLieBiao = [];
        $this->dingDianShu = 0;
        $this->zuoBiaoLieBiao = [];
        $this->linJieBiao = [];
        $this->dingDianFangWenLieBiao = [];
        $this->bianLiJieGuo = '';
        if (is_array($luJingLieBiao) && count($luJingLieBiao) > 0) {
            $this->luJingLieBiao = $luJingLieBiao;
            $this->gouZaoLinJieBiao();
        }
    }

    public function getLinJieBiao()
    {
        return [
            'dingDianLieBiao' => $this->dingDianLieBiao,
            'zuoBiaoLieBiao' => $this->zuoBiaoLieBiao,
            'linJieBiao' => $this->linJieBiao,
        ];
    }

    /**
     * 构造邻接表
     */
    protected function gouZaoLinJieBiao()
    {
        // 遍历统计顶点
        $this->dingDianShu = 0;
        foreach ($this->luJingLieBiao as $itemLuJing) {
            // 这里要统计所有的顶点，然后把顶点映射到坐标上
            if (!isset($this->dingDianLieBiao[$itemLuJing[0]])) {
                $this->dingDianLieBiao[$itemLuJing[0]] = $this->dingDianShu;
                $this->zuoBiaoLieBiao[$this->dingDianShu] = $itemLuJing[0];
                ++$this->dingDianShu;
            }
            if (!isset($this->dingDianLieBiao[$itemLuJing[1]])) {
                $this->dingDianLieBiao[$itemLuJing[1]] = $this->dingDianShu;
                $this->zuoBiaoLieBiao[$this->dingDianShu] = $itemLuJing[1];
                ++$this->dingDianShu;
            }
        }
        // 初始化邻接表，把所有的顶点先构造出来，边的关系链表初始化为空链表
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            $this->linJieBiao[$i]['ding_dian_zhi'] = $this->zuoBiaoLieBiao[$i];
            $this->linJieBiao[$i]['zhi_zhen'] = null;
        }
        // 构造邻接表，把所有有边关联的顶点都放到各自顶点的链表里去
        foreach ($this->luJingLieBiao as $itemLuJing) {
            $dingDian1 = $itemLuJing[0];
            $dingDian2 = $itemLuJing[1];
            $dingDian1ZuoBiao = $this->dingDianLieBiao[$dingDian1];
            $dingDian2ZuoBiao = $this->dingDianLieBiao[$dingDian2];
            $this->tianJiaJieDian($dingDian1ZuoBiao, $dingDian2ZuoBiao);
            $this->tianJiaJieDian($dingDian2ZuoBiao, $dingDian1ZuoBiao);
        }
    }

    /**
     * 添加邻接表结点
     * @param $dingDianZuoBiao
     * @param $tianJiaJieDianZuoBiao
     */
    protected function tianJiaJieDian($dingDianZuoBiao, $tianJiaJieDianZuoBiao)
    {
        if ($this->linJieBiao[$dingDianZuoBiao]['zhi_zhen'] === null) {
            $this->linJieBiao[$dingDianZuoBiao]['zhi_zhen'] = new LinJieBiaoJieDian($tianJiaJieDianZuoBiao);
        } else {
            // 循环到链表的末尾，再插入顶点
            $weiJieDian = $this->linJieBiao[$dingDianZuoBiao]['zhi_zhen'];
            while ($weiJieDian->zhiZhen !== null) {
                $weiJieDian = $weiJieDian->zhiZhen;
            }
            $weiJieDian->zhiZhen = new LinJieBiaoJieDian($tianJiaJieDianZuoBiao);
        }
    }

    /**
     * 深度优先遍历
     * @return string
     */
    public function shenDuYouXianBianLi()
    {
        $this->bianLiJieGuo = '';
        foreach ($this->zuoBiaoLieBiao as $key => $value) {
            $this->dingDianFangWenLieBiao[$key] = 0;
        }
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            if ($this->dingDianFangWenLieBiao[$i] === 0) {
                $this->shenDuYouXianBianLiDiGui($i);
            }
        }

        return $this->bianLiJieGuo;
    }

    protected function shenDuYouXianBianLiDiGui($i)
    {
        // 这里的逻辑和邻接矩阵是一个思路
        $this->bianLiJieGuo .= $this->zuoBiaoLieBiao[$i] . ';';
        $this->dingDianFangWenLieBiao[$i] = 1;
        $weiJieDian = $this->linJieBiao[$i]['zhi_zhen'];
        while ($weiJieDian->zhiZhen !== null) {
            if ($this->dingDianFangWenLieBiao[$weiJieDian->dingDianZuoBiao] === 0) {
                $this->shenDuYouXianBianLiDiGui($weiJieDian->dingDianZuoBiao);
            }
            $weiJieDian = $weiJieDian->zhiZhen;
        }
    }

    /**
     * 广度优先遍历
     * @return string
     */
    public function guangDuYouXianBianLi()
    {
        $this->bianLiJieGuo = '';
        foreach ($this->zuoBiaoLieBiao as $key => $value) {
            $this->dingDianFangWenLieBiao[$key] = 0;
        }
        // 邻接表的广度优先遍历和邻接矩阵的思路相同，也要用到队列
        $duiLie = [];
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            if ($this->dingDianFangWenLieBiao[$i] === 1) {
                continue;
            }
            $this->bianLiJieGuo .= $this->zuoBiaoLieBiao[$i] . ';';
            $this->dingDianFangWenLieBiao[$i] = 1;
            array_unshift($duiLie, $i);
            while (!empty($duiLie)) {
                $tempI = array_pop($duiLie);
                $zhiZhen = $this->linJieBiao[$tempI]['zhi_zhen'];
                while ($zhiZhen !== null) {
                    if ($this->dingDianFangWenLieBiao[$zhiZhen->dingDianZuoBiao] === 0) {
                        $this->bianLiJieGuo .= $this->zuoBiaoLieBiao[$zhiZhen->dingDianZuoBiao] . ';';
                        $this->dingDianFangWenLieBiao[$zhiZhen->dingDianZuoBiao] = 1;
                        array_unshift($duiLie, $zhiZhen->dingDianZuoBiao);
                    }
                    $zhiZhen = $zhiZhen->zhiZhen;
                }
            }
        }

        return $this->bianLiJieGuo;
    }
}

/* 测试代码 */

// $luJingLieBiao = [
//     ['V0', 'V1'], ['V0', 'V5'],
//     ['V1', 'V2'], ['V1', 'V8'], ['V1', 'V6'],
//     ['V2', 'V3'], ['V2', 'V8'],
//     ['V3', 'V4'], ['V3', 'V6'], ['V3', 'V7'], ['V3', 'V8'],
//     ['V4', 'V5'], ['V4', 'V7'],
//     ['V5', 'V6'],
//     ['V6', 'V7'],
// ];
// $wuXiangTu = new WuXiangTuLinJieBiao($luJingLieBiao);
// echo json_encode($wuXiangTu->getLinJieBiao());
// echo json_encode($wuXiangTu->shenDuYouXianBianLi());
// echo json_encode($wuXiangTu->guangDuYouXianBianLi());