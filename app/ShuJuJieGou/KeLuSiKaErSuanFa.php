<?php

namespace App\ShuJuJieGou;


class KeLuSiKaErSuanFa
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

    protected $paiXuHou;

    protected $parent;

    public function __construct($luJingLieBiao)
    {
        if (is_array($luJingLieBiao) && count($luJingLieBiao) > 0) {
            $this->luJingLieBiao = $luJingLieBiao;
        }
        $this->paiXuHou = [];

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

        $tempList = $luJingLieBiao;
        //取出数组中status的一列，返回一维数组
        $timeKey = array_column($tempList, 2);
        //排序，根据$status 排序
        array_multisort($timeKey, SORT_ASC, $tempList);

        foreach ($tempList as $item){
            $this->paiXuHou[] = [$this->dingDianLieBiao[$item[0]],$this->dingDianLieBiao[$item[1]],$item[2]];
        }

    }

    public function keLuSiKaErSuanFa()
    {
        // 记录最小生成树的边
        $zuiXiaoShenChengShu = [];
        $this->parent = [];
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            $this->parent[$i] = 0;
        }
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            $n = $this->find($this->paiXuHou[$i][0]);
            $m = $this->find($this->paiXuHou[$i][1]);
            if ($n !== $m) {
                $this->parent[$n] = $m;
                $zuiXiaoShenChengShu[] = [$this->zuoBiaoLieBiao[$this->paiXuHou[$i][0]], $this->zuoBiaoLieBiao[$this->paiXuHou[$i][1]]];
            }
        }
        return $zuiXiaoShenChengShu;
    }

    public function find($k)
    {
        while ($this->parent[$k] !== 0) {
            $k = $this->parent[$k];
        }
        return $k;
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
$wuXiangTu = new KeLuSiKaErSuanFa($luJingLieBiao);
// echo json_encode($wuXiangTu->getLinJieJuZhen());
echo json_encode($wuXiangTu->keLuSiKaErSuanFa());