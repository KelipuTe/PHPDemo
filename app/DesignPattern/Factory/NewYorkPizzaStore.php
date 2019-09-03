<?php

namespace App\DesignPattern\Factory;


require_once 'PizzaStore.php';
require 'NewYorkCheesePizza.php';

class NewYorkPizzaStore extends PizzaStore
{
    protected function createPizza(string $pizzaType)
    {
        if ($pizzaType == 'cheese') {
            return new NewYorkCheesePizza();
        } else if ($pizzaType == 'veggie') {
            return new NewYorkVeggiePizza();
        } else if ($pizzaType == 'clam') {
            return new NewYorkClamPizza();
        } else if ($pizzaType == 'pepperoni') {
            return new NewYorkPepperoniPizza();
        } else {
            return null;
        }
    }
}
