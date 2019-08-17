<?php

namespace App\DesignPattern\Decorator;


require_once 'Clothes.php';

class Shoes extends Clothes
{
    public function display()
    {
        parent::display();

        echo "穿上鞋子。\n";
    }
}
