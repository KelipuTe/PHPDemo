<?php

namespace App\ShuJuJieGou;

/**
 * Class LinJieBiaoJieDian [邻接表结点]
 * @package App\ShuJuJieGou
 */
class LinJieBiaoJieDian
{
    public $dingDianZuoBiao;

    public $zhiZhen;

    public function __construct($dingDianZuoBiao)
    {
        $this->dingDianZuoBiao = $dingDianZuoBiao;
        $this->zhiZhen = null;
    }
}