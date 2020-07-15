<?php

namespace App\ShuJuJieGou;


require_once 'ErChaShuJieDian.php';

/**
 * 哈夫曼树结点
 * Class HaFuManShuJieDian
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
     * @param string $jieDianZhi
     * @param int $quanZhong [结点权重]
     */
    public function __construct($jieDianZhi, $quanZhong)
    {
        parent::__construct($jieDianZhi);
        $this->quanZhong = $quanZhong;
    }
}