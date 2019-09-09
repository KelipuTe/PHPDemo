<?php

namespace App\DesignPattern\Decorator;


require_once 'ClothesAbstract.php';

class Overcoat extends ClothesAbstract
{
    public function display()
    {
        parent::display();

        echo "穿上外套。<br>\n";
    }
}
