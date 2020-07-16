<?php

namespace App\ShuJuJieGou;


/**
 * 二叉树结点
 * Class ErChaShuJieDian
 * @package App\ShuJuJieGou
 */
class ErChaShuJieDian
{
    /**
     * @var int [结点值]
     */
    public $jieDianZhi;

    /**
     * @var ErChaShuJieDian [左指针]
     */
    public $zuoZhiZhen;

    /**
     * @var ErChaShuJieDian [右指针]
     */
    public $youZhiZhen;

    /**
     * ErChaShuJieDian constructor.
     * @param $jieDianZhi [结点值]
     */
    public function __construct($jieDianZhi)
    {
        $this->jieDianZhi = $jieDianZhi;
        $this->zuoZhiZhen = null;
        $this->youZhiZhen = null;
    }
}