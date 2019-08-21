<?php

namespace App\DesignPattern\Decorator;


require_once 'ClothesInterface.php';

class Trousers extends Clothes
{
    public function display()
    {
        parent::display();

        echo "穿上裤子。\n";
    }
}