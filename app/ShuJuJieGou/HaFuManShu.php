<?php

namespace App\ShuJuJieGou;


require_once 'HaFuManShuJieDian.php';

/**
 * Class HaFuManShu [哈夫曼树]
 * @package App\ShuJuJieGou
 */
class HaFuManShu
{
    /**
     * 临时结点结点值，用于判断是不是有效结点
     */
    protected const TEMP_JIE_DIAN_ZHI = 'temp';

    /**
     * @var string [目标字符串]
     */
    protected $muBiaoZiFuChuan;

    /**
     * @var array [字符权重表]
     */
    protected $ziFuQuanZhongBiao;

    /**
     * @var array [哈夫曼编码表]
     */
    protected $haFuManBianMaBiao;

    /**
     * @var array [虚拟内存空间]
     * 用于模拟C语言中的指针
     */
    protected $xuNiNeiCunKongJian;

    /**
     * @var int [虚拟内存大小]
     * 用于记录分配内存的数量
     */
    protected $xuNiNeiCunDaXiao;

    /**
     * @var string [根结点指针]
     */
    protected $genJieDianZhiZhen;

    /**
     * HaFuManShu constructor.
     * @param string $muBiaoZiFuZhuan [目标字符串]
     */
    public function __construct($muBiaoZiFuZhuan)
    {
        $this->muBiaoZiFuChuan = '';
        $this->ziFuQuanZhongBiao = [];
        $this->haFuManBianMaBiao = [];
        $this->xuNiNeiCunKongJian = [];
        $this->xuNiNeiCunDaXiao = 0;
        $this->genJieDianZhiZhen = null;
        if (is_string($muBiaoZiFuZhuan) && strlen($muBiaoZiFuZhuan) > 0) {
            $this->muBiaoZiFuChuan = $muBiaoZiFuZhuan;
            $this->jiSuanZiFuQuanZhong();
            $this->gouZaoHaFuManShu();
            $this->gouZaoHaFuManBianMaBiao();
        }
    }

    /**
     * 获取哈夫曼树
     * @return array
     */
    public function getHaFuManShu()
    {
        return [
            'gen_jie_dian_zhi_zhen' => $this->genJieDianZhiZhen,
            'xu_ni_nei_cun_kong_jian' => $this->xuNiNeiCunKongJian
        ];
    }

    /**
     * 计算字符串中字符的权重
     */
    protected function jiSuanZiFuQuanZhong()
    {
        $chuanChang = strlen($this->muBiaoZiFuChuan);
        for ($i = 0; $i < $chuanChang; ++$i) {
            $char = $this->muBiaoZiFuChuan[$i];
            // 转义一下特殊字符，用这些特殊字符作为数组键名，不合适。
            if ($char === ' ') {
                $char = 'kong_ge';
            }
            if (isset($this->ziFuQuanZhongBiao[$char])) {
                ++$this->ziFuQuanZhongBiao[$char];
            } else {
                $this->ziFuQuanZhongBiao[$char] = 1;
            }
        }
        // 字符权重表按升序排序
        asort($this->ziFuQuanZhongBiao);
    }

    /**
     * 构造哈夫曼树
     */
    protected function gouZaoHaFuManShu()
    {
        $ziFuQuanZhongBiao = $this->ziFuQuanZhongBiao;
        while (count($ziFuQuanZhongBiao) > 1) {
            // 这里获取两个结点的逻辑是一样的，但是不适合做成方法，涉及到数组的删除，有点得不偿失。
            // 获取第一个结点
            reset($ziFuQuanZhongBiao);
            $keyZiFu1 = key($ziFuQuanZhongBiao);
            $quanZhong1 = $ziFuQuanZhongBiao[$keyZiFu1];
            if (isset($this->xuNiNeiCunKongJian[$keyZiFu1])) {
                $jieDianZhiZhen1 = $keyZiFu1;
                unset($ziFuQuanZhongBiao[$keyZiFu1]);
            } else {
                $jieDianZhiZhen1 = $this->fenPeiXuNiNeiCun($keyZiFu1, $quanZhong1);
                unset($ziFuQuanZhongBiao[$keyZiFu1]);
            }
            $jieDian1 = $this->xuNiNeiCunKongJian[$jieDianZhiZhen1];
            // 获取第二个结点
            $keyZiFu2 = key($ziFuQuanZhongBiao);
            $quanZhong2 = $ziFuQuanZhongBiao[$keyZiFu2];
            if (isset($this->xuNiNeiCunKongJian[$keyZiFu2])) {
                $jieDianZhiZhen2 = $keyZiFu2;
                unset($ziFuQuanZhongBiao[$keyZiFu2]);
            } else {
                $jieDianZhiZhen2 = $this->fenPeiXuNiNeiCun($keyZiFu2, $quanZhong2);
                unset($ziFuQuanZhongBiao[$keyZiFu2]);
            }
            $jieDian2 = $this->xuNiNeiCunKongJian[$jieDianZhiZhen2];
            // 构造上层结点
            $shangCengQuanZhong = $jieDian1->quanZhong + $jieDian2->quanZhong;
            $shangCengZhiZhen = $this->fenPeiXuNiNeiCun(self::TEMP_JIE_DIAN_ZHI, $shangCengQuanZhong);
            $shangcengJieDian = $this->xuNiNeiCunKongJian[$shangCengZhiZhen];
            if ($jieDian1->quanZhong <= $jieDian2->quanZhong) {
                $shangcengJieDian->zuoZhiZhen = $jieDianZhiZhen1;
                $shangcengJieDian->youZhiZhen = $jieDianZhiZhen2;
            } else {
                $shangcengJieDian->zuoZhiZhen = $jieDianZhiZhen2;
                $shangcengJieDian->youZhiZhen = $jieDianZhiZhen1;
            }
            // 将构造好的结点放回权重数组并升序排序
            $ziFuQuanZhongBiao[$shangCengZhiZhen] = $shangCengQuanZhong;
            asort($ziFuQuanZhongBiao);
        }
        reset($ziFuQuanZhongBiao);
        $this->genJieDianZhiZhen = key($ziFuQuanZhongBiao);
    }

    /**
     * 分配虚拟内存
     * @param $ziFu
     * @param $quanZhong
     * @return string
     */
    protected function fenPeiXuNiNeiCun($ziFu, $quanZhong)
    {
        $zhiZhen = 'zhi_zhen_' . $this->xuNiNeiCunDaXiao;
        ++$this->xuNiNeiCunDaXiao;
        $this->xuNiNeiCunKongJian[$zhiZhen] = new HaFuManShuJieDian($ziFu, $quanZhong);

        return $zhiZhen;
    }

    /**
     * 获取哈夫曼编码表
     * @return array
     */
    public function getHaFuManBianMaBiao()
    {
        return $this->haFuManBianMaBiao;
    }

    /**
     * 前序遍历构造哈夫曼编码表
     */
    protected function gouZaoHaFuManBianMaBiao()
    {
        $this->gouZaoHaFuManBianMaBiaoDiGui($this->genJieDianZhiZhen);
    }

    /**
     * @param string $genJieDianZhiZhen
     * @param string $qianZhui
     */
    protected function gouZaoHaFuManBianMaBiaoDiGui($genJieDianZhiZhen, $qianZhui = '')
    {
        if ($genJieDianZhiZhen === null) {
            return;
        }
        $genJieDian = $this->xuNiNeiCunKongJian[$genJieDianZhiZhen];
        if ($genJieDian->jieDianZhi === null) {
            return;
        }
        if ($genJieDian->jieDianZhi !== self::TEMP_JIE_DIAN_ZHI) {
            $this->haFuManBianMaBiao[$genJieDian->jieDianZhi] = $qianZhui;
        }
        $this->gouZaoHaFuManBianMaBiaoDiGui($genJieDian->zuoZhiZhen, $qianZhui . '0');
        $this->gouZaoHaFuManBianMaBiaoDiGui($genJieDian->youZhiZhen, $qianZhui . '1');
    }

    /**
     * 对目标字符串进行哈夫曼编码
     * @return string
     */
    public function ziFuChuanBianMa()
    {
        $bianMa = '';
        $chuanChang = strLen($this->muBiaoZiFuChuan);
        for ($i = 0; $i < $chuanChang; ++$i) {
            $char = $this->muBiaoZiFuChuan[$i];
            if ($char === ' ') {
                $char = 'kong_ge';
            }
            $bianMa .= $this->haFuManBianMaBiao[$char];
        }

        return $bianMa;
    }

    /**
     * 将哈夫曼编码进行解码
     * @param $bianMa [哈夫曼编码串]
     * @return string
     */
    public function ziFuChanJieMa($bianMa)
    {
        $jieMa = '';
        $shiBieMa = '';
        $haFuManJieMaBiao = array_flip($this->haFuManBianMaBiao);
        $chuanChang = strLen($bianMa);
        for ($i = 0; $i < $chuanChang; ++$i) {
            $shiBieMa .= $bianMa[$i];
            if (isset($haFuManJieMaBiao[$shiBieMa])) {
                if ($haFuManJieMaBiao[$shiBieMa] === 'kong_ge') {
                    $jieMa .= ' ';
                } else {
                    $jieMa .= $haFuManJieMaBiao[$shiBieMa];
                }
                // 匹配到一次之后，要把当前这个识别码置空，进行下一轮的匹配
                $shiBieMa = '';
            }
        }

        return $jieMa;
    }
}

/* 测试代码 */

// $muBiaoZiFuZhuan = 'hello world';
// $haFuManShu = new HaFuManShu($muBiaoZiFuZhuan);
// echo json_encode($haFuManShu->getHaFuManShu());
// echo json_encode($haFuManShu->getHaFuManBianMaBiao());
// $bianMa = $haFuManShu->ziFuChuanBianMa();
// echo json_encode($bianMa);
// echo json_encode($haFuManShu->ziFuChanJieMa($bianMa));
