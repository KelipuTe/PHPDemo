<?php

namespace App\DesignPattern\AbstractFactory;


require_once 'DoorFactoryInterface.php';
require 'WoodenDoor.php';
require 'Welder.php';

class WoodenDoorFactory implements DoorFactoryInterface
{
    public function makeDoor()
    {
        return new WoodenDoor(10, 20);
    }

    public function makeFittingExpert()
    {
        return new Welder();
    }
}
