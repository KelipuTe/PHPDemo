<?php

namespace App\DesignPattern\IOC;


require 'DatabaseLog.php';
require 'FileLog.php';

class LogService
{
    protected $log;

    public function __construct(LogInterface $log)
    {
        $this->log = $log;
    }

    public function saveLog()
    {
        $this->log->saveLog();
    }
}
