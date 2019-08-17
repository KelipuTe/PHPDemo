<?php

namespace App\DesignPattern\Decorator;


require_once 'Clothes.php';

class Overcoat extends Clothes
{
    public function display()
    {
        parent::display();

        echo "穿上外套。\n";
    }
}
