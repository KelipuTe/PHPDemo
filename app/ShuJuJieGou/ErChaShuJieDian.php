<?php

namespace App\ShuJuJieGou;


/**
 * Class ErChaShuJieDian [二叉树结点]
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
     * @param string $jieDianZhi [结点值]
     */
    public function __construct($jieDianZhi)
    {
        $this->jieDianZhi = '';
        $this->zuoZhiZhen = null;
        $this->youZhiZhen = null;
        if (is_string($jieDianZhi) && $jieDianZhi !== '') {
            $this->jieDianZhi = $jieDianZhi;
        }
    }
}