<?php

namespace App\DesignPattern\Factory;


require_once 'DoorFactoryInterface.php';

class WoodenDoorFactory implements DoorFactoryInterface
{
    public function makeDoor()
    {
        return new WoodenDoor();
    }

    public function makeFittingExpert()
    {
        return new Carpenter();
    }
}
