<?php

namespace App\DesignPattern\AbstractFactory;

require_once 'DoorFactoryInterface.php';
require 'IronDoor.php';
require 'Carpenter.php';

class IronDoorFactory implements DoorFactoryInterface
{
    public function makeDoor()
    {
        return new IronDoor(10, 20);
    }

    public function makeFittingExpert()
    {
        return new Carpenter();
    }
}