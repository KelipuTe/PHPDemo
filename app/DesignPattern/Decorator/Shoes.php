<?php

namespace App\DesignPattern\Decorator;


require_once 'ClothesAbstract.php';

class Shoes extends ClothesAbstract
{
    public function display()
    {
        parent::display();

        echo "穿上鞋子。<br>\n";
    }
}
