<?php

require '../IOC/IOC.php';
require '../IOC/LogService.php';
require 'LogServiceFacade.php';

use App\DesignPattern\Facade\LogServiceFacade;

$ioc = new IOC();
$ioc->bind('App\DesignPattern\IOC\LogInterface','App\DesignPattern\IOC\FileLog');
$ioc->bind('LogService','App\DesignPattern\IOC\LogService');

LogServiceFacade::setFacadeIoc($ioc);
LogServiceFacade::saveLog();
