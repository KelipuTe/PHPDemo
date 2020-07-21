<?php

namespace App\ShuJuJieGou;

/**
 * Class LinJieBiaoJieDian [邻接表结点]
 * @package App\ShuJuJieGou
 */
class LinJieBiaoJieDian
{
    /**
     * @var int
     */
    public $dingDianZuoBiao;

    /**
     * @var string
     */
    public $zhiZhen;

    /**
     * LinJieBiaoJieDian constructor.
     * @param $dingDianZuoBiao [顶点坐标]
     */
    public function __construct($dingDianZuoBiao)
    {
        $this->dingDianZuoBiao = -1;
        $this->zhiZhen = null;
        if (is_numeric($dingDianZuoBiao)) {
            $this->dingDianZuoBiao = $dingDianZuoBiao;
        }
    }
}