<?php

namespace App\ShuJuJieGou;


require_once 'ErChaShuJieDian.php';

/**
 * Class PingHengErChaShuJieDian [平衡二叉树结点]
 * @package App\ShuJuJieGou
 */
class PingHengErChaShuJieDian extends ErChaShuJieDian
{
    /**
     * @var string [父结点指针]
     */
    public $fuZhiZhen;

    /**
     * @var int [结点深度]
     */
    public $jieDianShenDu;

    /**
     * @var int [平衡参数，左右子树深度的差值]
     * 如果算出来是，[-1,0,1]，就是平衡的
     */
    public $pingHengCanShu;

    public function __construct($jieDianZhi)
    {
        $this->fuZhiZhen = null;
        $this->jieDianShenDu = 0;
        $this->pingHengCanShu = 0;
        parent::__construct($jieDianZhi);
    }
}