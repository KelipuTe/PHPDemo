<?php

namespace App\DesignPattern\Decorator;


require_once 'ClothesInterface.php';

class Shoes extends Clothes
{
    public function display()
    {
        parent::display();

        echo "穿上鞋子。\n";
    }
}
