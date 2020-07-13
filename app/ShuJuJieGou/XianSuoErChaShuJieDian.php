<?php
/* 线索二叉树结点 */

namespace App\ShuJuJieGou;


/**
 * Class ShuJieDian [线索二叉树结点]
 * @package App\ShuJuJieGou
 */
class XianSuoErChaShuJieDian
{
    /**
     * @var int [结点值]
     */
    public $jieDianZhi;

    /**
     * @var int [左标识]
     * -1=未设置；0=前驱；1=左孩子
     */
    public $zuoBiaoShi;

    /**
     * @var XianSuoErChaShuJieDian [左指针]
     */
    public $zuoZhiZhen;

    /**
     * @var int [右标识]
     * -1=未设置；0=后继；1=右孩子
     */
    public $youBiaoShi;

    /**
     * @var XianSuoErChaShuJieDian [右指针]
     */
    public $youZhiZhen;

    /**
     * ShuJieDian constructor.
     * @param $jieDianZhi [结点值]
     */
    public function __construct($jieDianZhi)
    {
        $this->jieDianZhi = $jieDianZhi;
        $this->zuoZhiZhen = null;
        $this->zuoBiaoShi = -1;
        $this->youZhiZhen = null;
        $this->youBiaoShi = -1;
    }
}