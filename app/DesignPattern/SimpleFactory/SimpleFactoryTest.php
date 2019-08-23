<?php

require 'DataBaseFactory.php';

use App\DesignPattern\SimpleFactory\DataBaseFactory;

$database1 = DataBaseFactory::makeConnection('mysql');
$database1->select('id')->get();

$database2 = DataBaseFactory::makeConnection('redis');
$database2->select('cache')->get();
