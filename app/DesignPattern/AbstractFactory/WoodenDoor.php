<?php

namespace App\DesignPattern\Factory;


require_once 'DoorAbstract.php';

class WoodenDoor extends DoorAbstract
{
    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
}
