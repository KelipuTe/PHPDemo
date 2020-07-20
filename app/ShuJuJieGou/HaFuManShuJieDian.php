<?php

namespace App\ShuJuJieGou;


require_once 'ErChaShuJieDian.php';

/**
 * Class HaFuManShuJieDian [哈夫曼树结点]
 * @package App\ShuJuJieGou
 */
class HaFuManShuJieDian extends ErChaShuJieDian
{
    /**
     * @var int [结点权重]
     */
    public $quanZhong;

    /**
     * HaFuManShuJieDian constructor.
     * @param string $jieDianZhi [结点值]
     * @param int $quanZhong [结点权重]
     */
    public function __construct($jieDianZhi, $quanZhong)
    {
        parent::__construct($jieDianZhi);
        $this->quanZhong = 0;
        if (is_numeric($quanZhong) && $quanZhong > 0) {
            $this->quanZhong = $quanZhong;
        }
    }
}