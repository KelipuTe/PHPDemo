<?php

require 'WoodenDoorFactory.php';
require 'IronDoorFactory.php';

use App\DesignPattern\AbstractFactory\IronDoorFactory;
use App\DesignPattern\AbstractFactory\WoodenDoorFactory;

$woodenDoorFactory = new WoodenDoorFactory();
$door1 = $woodenDoorFactory->makeDoor();
$worker1 = $woodenDoorFactory->makeFittingExpert();
$door1->getArea();
$worker1->getDescription();

$ironDoorFactory = new IronDoorFactory();
$door2 = $ironDoorFactory->makeDoor();
$worker2 = $ironDoorFactory->makeFittingExpert();
$door2->getArea();
$worker2->getDescription();
