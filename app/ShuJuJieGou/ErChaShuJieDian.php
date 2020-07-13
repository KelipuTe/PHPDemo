<?php
/* 二叉树结点 */

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
     * @var ErChaShuJieDian [左子树]
     */
    public $zuoZiShu;

    /**
     * @var ErChaShuJieDian [右子树]
     */
    public $youZiShu;

    /**
     * ErChaShuJieDian constructor.
     * @param $jieDianZhi [结点值]
     */
    public function __construct($jieDianZhi)
    {
        $this->jieDianZhi = $jieDianZhi;
        $this->zuoZiShu = null;
        $this->youZiShu = null;
    }
}