<?php

namespace App\ShuJuJieGou;


require_once 'WuXiangTuJuZhen.php';

/**
 * Class PuLiMuSuanFa [普里姆算法]
 * @package App\ShuJuJieGou
 */
class PuLiMuSuanFa extends WuXiangTuJuZhen
{
    /**
     * 临界权重，用于标记
     */
    protected const LIN_JIE_QUAN_ZHONG = 65535;

    /**
     * PuLiMuSuanFa constructor.
     * @param array $luJingLieBiao [无向图路径列表]
     */
    public function __construct($luJingLieBiao)
    {
        parent::__construct($luJingLieBiao);
    }

    protected function gouZaoLinJieJuZhen()
    {
        $this->dingDianShu = 0;
        foreach ($this->luJingLieBiao as $itemLuJing) {
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
        // 初始化邻接矩阵，这里和普通邻接矩阵初始化的方式不一样
        // 初始化的时候除了对角线默认所有的值都是临界权重，对角线默认为0，自己到自己当然是0
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            for ($j = 0; $j < $this->dingDianShu; ++$j) {
                $this->linJieJuZhen[$i][$j] = self::LIN_JIE_QUAN_ZHONG;
            }
            $this->linJieJuZhen[$i][$i] = 0;
        }
        foreach ($this->luJingLieBiao as $itemLuJing) {
            $dingDian1 = $itemLuJing[0];
            $dingDian2 = $itemLuJing[1];
            $quanZhong = $itemLuJing[2];
            $dingDian1ZuoBiao = $this->dingDianLieBiao[$dingDian1];
            $dingDian2ZuoBiao = $this->dingDianLieBiao[$dingDian2];
            $this->linJieJuZhen[$dingDian1ZuoBiao][$dingDian2ZuoBiao] = $quanZhong;
            $this->linJieJuZhen[$dingDian2ZuoBiao][$dingDian1ZuoBiao] = $quanZhong;
        }
    }

    /**
     * 普里姆算法
     * @return array
     */
    public function puLiMuSuanFa()
    {
        // 记录最小生成树的边
        $zuiXiaoShenChengShu = [];
        // 记录最小生成树的顶点，到达不在最小生成树中的各个顶点的最小路径权重，如果没有路径到达对应的顶点，就默认设置为临界权重
        $zuiXiaoQuanZhongLieBiao = [];
        // 相关顶点用于记录上面最小路径权重的来源，即对应的路径是从哪个顶点出来的
        $xiangGuanDingDianLieBiao = [];
        // 默认从顶点V0开始
        $qiShiDingDian = 0;
        // 已经录入最小生成树的顶点，最小路径权重就标为0，表示顶点已经在最小生成树中
        $zuiXiaoQuanZhongLieBiao[$qiShiDingDian] = 0;
        // 因为是从顶点V0开始的，所以默认V0顶点是从V0出发的
        $xiangGuanDingDianLieBiao[$qiShiDingDian] = 0;
        // 初始化，因为是从顶点V0开始的，所以初始化的时候，最小路径全部默认是从V0出发的
        for ($i = 1; $i < $this->dingDianShu; ++$i) {
            $zuiXiaoQuanZhongLieBiao[$i] = $this->linJieJuZhen[$qiShiDingDian][$i];
            $xiangGuanDingDianLieBiao[$i] = 0;
        }
        // 每轮判断都是寻找从当前已经找到的最小生成树的顶点出发的所有边中最小权重的边和对应的那个顶点
        for ($i = 1; $i < $this->dingDianShu; ++$i) {
            $zuiXiaoQuanZhong = self::LIN_JIE_QUAN_ZHONG;
            $k = 0;
            // 循环比较本次从最小生成树顶点出发的所有边的权重，找出最小的边
            for ($j = 1; $j < $this->dingDianShu; ++$j) {
                if ($zuiXiaoQuanZhongLieBiao[$j] !== 0 && $zuiXiaoQuanZhongLieBiao[$j] < $zuiXiaoQuanZhong) {
                    $zuiXiaoQuanZhong = $zuiXiaoQuanZhongLieBiao[$j];
                    $k = $j;
                }
                ++$j;
            }
            // 用当前最小权重边的坐标和最小权重边的来源坐标可以表示出一条边
            $zuiXiaoShenChengShu[] = [$this->zuoBiaoLieBiao[$xiangGuanDingDianLieBiao[$k]], $this->zuoBiaoLieBiao[$k]];
            // 把这个顶点标记为已找到
            $zuiXiaoQuanZhongLieBiao[$k] = 0;
            for ($j = 1; $j < $this->dingDianShu; ++$j) {
                // 把新找到的顶点加入最小生成树，然后把从这个顶点出发的边和当前的最小路劲比较一下，权重更小的路径加入下一轮的判断
                if ($zuiXiaoQuanZhongLieBiao[$j] !== 0 && $this->linJieJuZhen[$k][$j] < $zuiXiaoQuanZhongLieBiao[$j]) {
                    $zuiXiaoQuanZhongLieBiao[$j] = $this->linJieJuZhen[$k][$j];
                    $xiangGuanDingDianLieBiao[$j] = $k;
                }
            }
        }

        return $zuiXiaoShenChengShu;
    }
}

/* 测试代码 */

$luJingLieBiao = [
    ['V0', 'V1', 10], ['V0', 'V5', 11],
    ['V1', 'V2', 18], ['V1', 'V8', 12], ['V1', 'V6', 16],
    ['V2', 'V3', 22], ['V2', 'V8', 8],
    ['V3', 'V4', 20], ['V3', 'V6', 24], ['V3', 'V7', 16], ['V3', 'V8', 21],
    ['V4', 'V5', 26], ['V4', 'V7', 7],
    ['V5', 'V6', 17],
    ['V6', 'V7', 19],
];
$wuXiangTu = new PuLiMuSuanFa($luJingLieBiao);
// echo json_encode($wuXiangTu->getLinJieJuZhen());
echo json_encode($wuXiangTu->puLiMuSuanFa());
