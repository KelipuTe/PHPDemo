<?php

namespace App\DesignPattern\AbstractFactory;


require_once 'DoorFittingExpertInterface.php';

class Carpenter implements DoorFittingExpertInterface
{
    public function getDescription()
    {
        echo "I can only fit iron doors.<br>\n";
    }
}
