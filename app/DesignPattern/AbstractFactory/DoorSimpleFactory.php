<?php

namespace App\DesignPattern\Factory;


require 'WoodenDoor.php';

class DoorSimpleFactory
{
    public function makeDoor($width, $height, $doorType = 'wooden')
    {
        return new WoodenDoor($width, $height);
    }
}
