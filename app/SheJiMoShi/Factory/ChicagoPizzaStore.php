<?php

namespace App\DesignPattern\Factory;


require_once 'PizzaStore.php';

class ChicagoPizzaStore extends PizzaStore
{
    protected function createPizza(string $pizzaType): Pizza
    {
        if ($pizzaType == 'cheese') {
            return new ChicagoCheesePizza();
        } else if ($pizzaType == 'veggie') {
            return new ChicagoVeggiePizza();
        } else if ($pizzaType == 'clam') {
            return new ChicagoClamPizza();
        } else if ($pizzaType == 'pepperoni') {
            return new ChicagoPepperoniPizza();
        } else {
            return null;
        }
    }
}
