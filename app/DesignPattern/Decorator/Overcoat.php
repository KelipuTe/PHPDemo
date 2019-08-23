<?php

namespace App\DesignPattern\Decorator;


require_once 'ClothesInterface.php';

class Overcoat extends Clothes
{
    public function display()
    {
        parent::display();

        echo "穿上外套。<br>\n";
    }
}
