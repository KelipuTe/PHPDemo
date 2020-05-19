<?php

require 'IOC.php';
require 'LogService.php';

$ioc = new IOC();
// $ioc->bind('App\SheJiMoShi\IOC\LogInterface','App\SheJiMoShi\IOC\DataBaseLog');
$ioc->bind('App\DesignPattern\IOC\LogInterface','App\DesignPattern\IOC\FileLog');
$ioc->bind('LogService','App\DesignPattern\IOC\LogService');

$logService = $ioc->make('LogService');
$logService->saveLog();