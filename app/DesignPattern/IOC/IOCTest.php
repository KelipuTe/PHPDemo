<?php

require 'IOC.php';

$ioc = new IOC();
// $ioc->bind('App\DesignPattern\IOC\LogInterface','App\DesignPattern\IOC\DataBaseLog');
$ioc->bind('App\DesignPattern\IOC\LogInterface','App\DesignPattern\IOC\FileLog');
$ioc->bind('App\DesignPattern\IOC\LogService','App\DesignPattern\IOC\LogService');
$logService = $ioc->make('App\DesignPattern\IOC\LogService');
$logService->saveLog();
