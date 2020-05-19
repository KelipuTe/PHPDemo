<?php

namespace App\SheJiMoShi\KongZhiFanZhuan;


require_once 'LogInterface.php';

class DatabaseLog implements LogInterface
{
    public function saveLog()
    {
        echo "save log by database.<br>\n";
    }
}
