<?php

namespace App\DesignPattern\Factory;


require_once 'Pizza.php';

class NewYorkCheesePizza extends Pizza
{
    public function __construct()
    {
        $this->name = 'NewYork Style Sauce and Cheese Pizza';
        $this->dough = 'Thin Crust Dough';
        $this->sauce = 'Marinara Sauce';

        $this->toppings[] = 'Grated Reggiano Cheese';
    }
}
