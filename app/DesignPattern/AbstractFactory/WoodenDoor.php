<?php

namespace App\DesignPattern\AbstractFactory;


require_once 'DoorAbstract.php';

class WoodenDoor extends DoorAbstract
{
    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }
}
