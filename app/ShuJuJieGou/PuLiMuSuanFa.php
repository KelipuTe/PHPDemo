<?php

namespace App\ShuJuJieGou;


class PuLiMuSuanFa
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
     * @var array [邻接矩阵]
     */
    protected $linJieJuZhen;

    /**
     * PuLiMuSuanFa constructor.
     * @param $luJingLieBiao
     */
    public function __construct($luJingLieBiao)
    {
        if (is_array($luJingLieBiao) && count($luJingLieBiao) > 0) {
            $this->luJingLieBiao = $luJingLieBiao;
            $this->gouZaoLinJieJuZhen();
        }
    }

    /**
     * @return array
     */
    public function getLinJieJuZhen()
    {
        return $this->linJieJuZhen;
    }

    /**
     * 构造邻接矩阵
     */
    protected function gouZaoLinJieJuZhen()
    {
        // 遍历统计顶点
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
        // 初始化邻接矩阵
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            for ($j = 0; $j < $this->dingDianShu; ++$j) {
                $this->linJieJuZhen[$i][$j] = 65535;
            }
            $this->linJieJuZhen[$i][$i] = 0;
        }
        // 构造邻接矩阵
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

    public function puLiMuSuanFa()
    {
        // 记录最小生成树的边
        $zuiXiaoShenChengShu = [];
        // 设置一个临界值用于初始化
        $linJieQuanZhong = 65535;
        // 记录到达各个顶点的最小路径权重，没有路径就默认临界值用于区分
        $zuiXiaoQuanZhongLieBiao = [];
        // 相关顶点用于记录上面最小路径权重的来源，即最小路劲是由那个顶点出来的
        $xiangGuanDingDianLieBiao = [];
        // 默认从顶点V0开始
        $qiShiDingDian = 0;
        // 已经录入最小生成树的结点路径就标为0表示已经找到了
        $zuiXiaoQuanZhongLieBiao[$qiShiDingDian] = 0;
        // 因为是从顶点V0开始的
        $xiangGuanDingDianLieBiao[$qiShiDingDian] = 0;
        // 初始化
        for ($i = 1; $i < $this->dingDianShu; ++$i) {
            $zuiXiaoQuanZhongLieBiao[$i] = $this->linJieJuZhen[$qiShiDingDian][$i];
            $xiangGuanDingDianLieBiao[$i] = 0;
        }
        for ($i = 1; $i < $this->dingDianShu; ++$i) {
            $zuiXiaoQuanZhong = $linJieQuanZhong;
            $j = 1;
            $k = 0;
            // 循环比较本次从最小生成树顶点出发的所有边的权重，找出最小的边
            while ($j < $this->dingDianShu) {
                if ($zuiXiaoQuanZhongLieBiao[$j] !== 0 && $zuiXiaoQuanZhongLieBiao[$j] < $zuiXiaoQuanZhong) {
                    $zuiXiaoQuanZhong = $zuiXiaoQuanZhongLieBiao[$j];
                    $k = $j;
                }
                ++$j;
            }
            // 当前最小权重边的坐标和最小权重来源坐标可以表示出一条边
            $zuiXiaoShenChengShu[] = [$this->zuoBiaoLieBiao[$xiangGuanDingDianLieBiao[$k]], $this->zuoBiaoLieBiao[$k]];
            // 把这个顶点标记为已找到
            $zuiXiaoQuanZhongLieBiao[$k] = 0;
            for ($j = 1; $j < $this->dingDianShu; ++$j) {
                // 把新找到的结点加入最小生成树，然后把从这个结点出发的边加入下一轮的判断
                if ($zuiXiaoQuanZhongLieBiao[$j] !== 0 && $this->linJieJuZhen[$k][$j] < $zuiXiaoQuanZhongLieBiao[$j]) {
                    $zuiXiaoQuanZhongLieBiao[$j] = $this->linJieJuZhen[$k][$j];
                    $xiangGuanDingDianLieBiao[$j] = $k;
                }
            }
            // 每次判断都是寻找从当前已经找到的最小生成树出发的所有边中最小权重的边
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
