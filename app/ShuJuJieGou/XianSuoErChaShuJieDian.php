<?php

namespace App\ShuJuJieGou;


require_once 'ErChaShuJieDian.php';

/**
 * Class ShuJieDian [线索二叉树结点]
 * @package App\ShuJuJieGou
 */
class XianSuoErChaShuJieDian extends ErChaShuJieDian
{
    /**
     * @var int [左标识]
     * -1=未设置；0=前驱；1=左孩子
     */
    public $zuoBiaoShi;

    /**
     * @var int [右标识]
     * -1=未设置；0=后继；1=右孩子
     */
    public $youBiaoShi;

    /**
     * ShuJieDian constructor.
     * @param $jieDianZhi [结点值]
     */
    public function __construct($jieDianZhi)
    {
        $this->zuoBiaoShi = -1;
        $this->youBiaoShi = -1;
        parent::__construct($jieDianZhi);
    }
}