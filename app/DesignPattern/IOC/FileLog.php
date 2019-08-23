<?php

namespace App\DesignPattern\IOC;


require_once 'LogInterface.php';

class FileLog implements LogInterface
{
    public function saveLog()
    {
        echo "save log by file.<br>\n";
    }
}
