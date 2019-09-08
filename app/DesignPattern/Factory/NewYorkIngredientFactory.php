<?php

namespace App\DesignPattern\Factory;


require_once 'PizzaIngredientFactory.php';

class NewYorkIngredientFactory implements PizzaIngredientFactory
{
    public function createDough()
    {
        return 'Thin Crust Dough';
    }

    public function createSauce()
    {
        return 'Marinara Sauce';
    }

    public function createCheese()
    {
        return 'Reggiano Cheese';
    }

    public function createVeggies()
    {
        return ['onion', 'Mushroom'];
    }

    public function createPepperoni()
    {
        return 'Slice Pepperoni';
    }

    public function createClam()
    {
        return 'Fresh Clams';
    }
}