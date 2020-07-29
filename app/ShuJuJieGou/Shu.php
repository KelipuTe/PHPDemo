<?php

namespace App\ShuJuJieGou;


require_once 'XuNiNeiCunTrait.php';
require_once 'ShuJieDian.php';

/**
 * Class Shu [树]
 * @package App\ShuJuJieGou
 */
class Shu
{
    use XuNiNeiCunTrait;

    /**
     * 临时结点结点值，用于判断是不是有效结点
     */
    protected const TEMP_JIE_DIAN_ZHI = 'temp';

    /**
     * @var array [关系表]
     */
    protected $guanXiBiao;

    /**
     * @var string [结点id和虚拟内存指针对照表]
     */
    protected $idHeZhiZhenDuiZhaoBiao;

    /**
     * @var string [根结点指针]
     */
    protected $genJieDianZhiZhen;

    /**
     * Shu constructor.
     * @param array $guanXiBiao
     */
    public function __construct($guanXiBiao = [])
    {
        $this->xuNiNeiCunChuShiHua();
        $this->guanXiBiao = [];
        $this->idHeZhiZhenDuiZhaoBiao = [];
        $this->genJieDianZhiZhen = null;
        if (is_array($guanXiBiao) && count($guanXiBiao) > 0) {
            $this->guanXiBiao = $guanXiBiao;
            $this->gouZaoShu();
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
        $this->xuNiNeiCunKongJian[$zhiZhen] = new ShuJieDian($jieDianZhi);

        return $zhiZhen;
    }

    /**
     * 构造树
     */
    protected function gouZaoShu()
    {
        if (count($this->guanXiBiao) < 1) {
            return;
        }
        foreach ($this->guanXiBiao as $key => $item) {
            if (isset($this->idHeZhiZhenDuiZhaoBiao[$key])) {
                // 如果结点已经创建了，说明是子结点创建的临时结点
                $jieDianZhiZhen = $this->idHeZhiZhenDuiZhaoBiao[$key];
                $jieDian = $this->huoQuNeiCunShuJu($jieDianZhiZhen);
                $jieDian->jieDianZhi = $item['jie_dian_zhi'];
            } else {
                $jieDianZhiZhen = $this->fenPeiXuNiNeiCun($item['jie_dian_zhi']);
                $jieDian = $this->huoQuNeiCunShuJu($jieDianZhiZhen);
                $this->idHeZhiZhenDuiZhaoBiao[$key] = $jieDianZhiZhen;
            }
            if ($item['fu_zhi_zhen'] === null) {
                // 没有父结点，那这个结点就是根结点
                $this->genJieDianZhiZhen = $jieDianZhiZhen;
            } else {
                // 有父节点就要把这个结点连到父结点
                $fuJieDianId = $item['fu_zhi_zhen'];
                if (isset($this->idHeZhiZhenDuiZhaoBiao[$fuJieDianId])) {
                    $fuJieDianZhiZhen = $this->idHeZhiZhenDuiZhaoBiao[$fuJieDianId];
                    $fuJieDian = $this->huoQuNeiCunShuJu($fuJieDianZhiZhen);
                    $fuJieDian->zhiZhenYu[] = $jieDianZhiZhen;
                } else {
                    $fuJieDianZhiZhen = $this->fenPeiXuNiNeiCun(self::TEMP_JIE_DIAN_ZHI);
                    $fuJieDian = $this->huoQuNeiCunShuJu($fuJieDianZhiZhen);
                    $fuJieDian->zhiZhenYu[] = $jieDianZhiZhen;
                    $this->idHeZhiZhenDuiZhaoBiao[$fuJieDianId] = $fuJieDian;
                }
                $jieDian->fuZhiZhen = $fuJieDianZhiZhen;
            }
        }
    }

    /**
     * 获取树
     * @return array
     */
    public function getShu()
    {
        return [
            'genJieDianZhiZhen' => $this->genJieDianZhiZhen,
            'idHeZhiZhenDuiZhaoBiao' => $this->idHeZhiZhenDuiZhaoBiao,
            'xuNiNeiCunKongJian' => $this->xuNiNeiCunKongJian
        ];
    }
}

/* 测试代码 */

// $guanXiBiao = [
//     'id01' => ['jie_dian_zhi' => 1, 'fu_zhi_zhen' => null],
//     'id02' => ['jie_dian_zhi' => 2, 'fu_zhi_zhen' => 'id01'],
//     'id03' => ['jie_dian_zhi' => 3, 'fu_zhi_zhen' => 'id01'],
//     'id04' => ['jie_dian_zhi' => 4, 'fu_zhi_zhen' => 'id02'],
//     'id05' => ['jie_dian_zhi' => 5, 'fu_zhi_zhen' => 'id02'],
//     'id06' => ['jie_dian_zhi' => 6, 'fu_zhi_zhen' => 'id02'],
//     'id07' => ['jie_dian_zhi' => 7, 'fu_zhi_zhen' => 'id03'],
// ];
// $shu = new Shu($guanXiBiao);
// echo json_encode($shu->getShu());