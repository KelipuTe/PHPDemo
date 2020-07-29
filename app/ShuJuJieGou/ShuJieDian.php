<?php

namespace App\ShuJuJieGou;

/**
 * Class ShuJieDian [树节点]
 * @package App\ShuJuJieGou
 */
class ShuJieDian
{
    /**
     * @var int [结点值]
     */
    public $jieDianZhi;

    /**
     * @var ErChaShuJieDian [父指针]
     */
    public $fuZhiZhen;

    /**
     * @var array [孩子指针数组]
     */
    public $zhiZhenYu;

    /**
     * ShuJieDian constructor.
     * @param string $jieDianZhi [结点值]
     */
    public function __construct($jieDianZhi)
    {
        $this->jieDianZhi = '';
        $this->fuZhiZhen = null;
        $this->zhiZhenYu = [];
        if (is_numeric($jieDianZhi) || (is_string($jieDianZhi) && $jieDianZhi !== '')) {
            $this->jieDianZhi = $jieDianZhi;
        }
    }
}