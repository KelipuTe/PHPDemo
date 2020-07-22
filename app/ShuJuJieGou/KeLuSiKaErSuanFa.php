<?php

namespace App\ShuJuJieGou;


require_once 'WuXiangTuJuZhen.php';

/**
 * Class KeLuSiKaErSuanFa [克鲁斯卡尔算法]
 * @package App\ShuJuJieGou
 */
class KeLuSiKaErSuanFa extends WuXiangTuJuZhen
{
    /**
     * @var array [排序过的路径权重列表]
     */
    protected $luJingQuanZhongLieBiao;

    /**
     * KeLuSiKaErSuanFa constructor.
     * @param array $luJingLieBiao [无向图路径列表]
     */
    public function __construct($luJingLieBiao)
    {
        $this->luJingQuanZhongLieBiao = [];
        parent::__construct($luJingLieBiao);
    }

    public function gouZaoLinJieJuZhen()
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
        // 克鲁斯卡尔算法不需要把邻接矩阵构造出来
        $tempLieBiao = $this->luJingLieBiao;
        // 取出列表中权重那一列，作为排序依据
        $paiXuYiJu = array_column($tempLieBiao, 2);
        // 对路径列表按照权重升序排序
        array_multisort($paiXuYiJu, SORT_ASC, $tempLieBiao);
        // 构造排序过的路径权重列表
        foreach ($tempLieBiao as $item) {
            $this->luJingQuanZhongLieBiao[] = [
                $this->dingDianLieBiao[$item[0]],
                $this->dingDianLieBiao[$item[1]],
                $item[2]
            ];
        }
    }

    /**
     * 克鲁斯卡尔算法
     * @return array
     */
    public function keLuSiKaErSuanFa()
    {
        // 记录最小生成树的边
        $zuiXiaoShenChengShu = [];
        // 记录顶点来源，用于判断顶点是不是已经在生成树上了
        $dingDianLaiYuanBiao = [];
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            $dingDianLaiYuanBiao[$i] = 0;
        }
        for ($i = 0; $i < $this->dingDianShu; ++$i) {
            $m = $this->find($dingDianLaiYuanBiao, $this->luJingQuanZhongLieBiao[$i][0]);
            $n = $this->find($dingDianLaiYuanBiao, $this->luJingQuanZhongLieBiao[$i][1]);
            if ($m !== $n) {
                $dingDianLaiYuanBiao[$m] = $n;
                $zuiXiaoShenChengShu[] = [
                    $this->zuoBiaoLieBiao[$this->luJingQuanZhongLieBiao[$i][0]],
                    $this->zuoBiaoLieBiao[$this->luJingQuanZhongLieBiao[$i][1]]
                ];
            }
        }

        return $zuiXiaoShenChengShu;
    }

    protected function find($dingDianLaiYuanBiao, $k)
    {
        while ($dingDianLaiYuanBiao[$k] !== 0) {
            $k = $dingDianLaiYuanBiao[$k];
        }

        return $k;
    }
}

/* 测试代码 */

// $luJingLieBiao = [
//     ['V0', 'V1', 10], ['V0', 'V5', 11],
//     ['V1', 'V2', 18], ['V1', 'V8', 12], ['V1', 'V6', 16],
//     ['V2', 'V3', 22], ['V2', 'V8', 8],
//     ['V3', 'V4', 20], ['V3', 'V6', 24], ['V3', 'V7', 16], ['V3', 'V8', 21],
//     ['V4', 'V5', 26], ['V4', 'V7', 7],
//     ['V5', 'V6', 17],
//     ['V6', 'V7', 19],
// ];
// $wuXiangTu = new KeLuSiKaErSuanFa($luJingLieBiao);
// echo json_encode($wuXiangTu->getLinJieJuZhen());
// echo json_encode($wuXiangTu->keLuSiKaErSuanFa());