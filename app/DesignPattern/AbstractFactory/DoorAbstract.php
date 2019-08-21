<?php

namespace App\DesignPattern\AbstractFactory;


abstract class DoorAbstract
{
    protected $width;

    protected $height;

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
}
