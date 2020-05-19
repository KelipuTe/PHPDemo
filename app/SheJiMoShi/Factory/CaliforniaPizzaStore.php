<?php

namespace App\DesignPattern\Factory;


require_once 'PizzaStore.php';

class CaliforniaPizzaStore extends PizzaStore
{
    protected function createPizza(string $pizzaType): Pizza
    {
        if ($pizzaType == 'cheese') {
            return new CaliforniaCheesePizza();
        } else if ($pizzaType == 'veggie') {
            return new CaliforniaVeggiePizza();
        } else if ($pizzaType == 'clam') {
            return new CaliforniaClamPizza();
        } else if ($pizzaType == 'pepperoni') {
            return new CaliforniaPepperoniPizza();
        } else {
            return null;
        }
    }
}
