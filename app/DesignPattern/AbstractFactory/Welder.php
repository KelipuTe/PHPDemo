<?php

namespace App\DesignPattern\AbstractFactory;


require_once 'DoorFittingExpertInterface.php';

class Welder implements DoorFittingExpertInterface
{
    public function getDescription()
    {
        echo "I can only fit wooden doors.<br>\n";
    }
}
