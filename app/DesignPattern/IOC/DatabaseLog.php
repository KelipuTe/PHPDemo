<?php

namespace App\DesignPattern\IOC;


require_once 'LogInterface.php';

class DatabaseLog implements LogInterface
{
    public function saveLog()
    {
        echo "save log by database\n";
    }
}
