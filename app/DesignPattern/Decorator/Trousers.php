<?php

namespace App\DesignPattern\Decorator;


require_once 'ClothesAbstract.php';

class Trousers extends ClothesAbstract
{
    public function display()
    {
        parent::display();

        echo "穿上裤子。<br>\n";
    }
}
