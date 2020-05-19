<?php

namespace App\DesignPattern\Factory;


require_once 'PizzaStore.php';
require 'NewYorkIngredientFactory.php';
require_once 'CheesePizza.php';
require_once 'VeggiePizza.php';
require_once 'ClamPizza.php';
require_once 'PepperoniPizza.php';

class NewYorkPizzaStore extends PizzaStore
{
    /**
     * @param string $pizzaType
     * @return Pizza
     * @throws \Exception
     */
    protected function createPizza(string $pizzaType): Pizza
    {
        $pizza = null;
        $pizzaIngredientFactory = new NewYorkIngredientFactory();

        if ($pizzaType == 'cheese') {
            $pizza = new CheesePizza($pizzaIngredientFactory);
            $pizza->setName('New York Style Cheese Pizza');
        } else if ($pizzaType == 'veggie') {
            $pizza = new VeggiePizza($pizzaIngredientFactory);
            $pizza->setName('New York Style Veggie Pizza');
        } else if ($pizzaType == 'clam') {
            $pizza = new ClamPizza($pizzaIngredientFactory);
            $pizza->setName('New York Style Clam Pizza');
        } else if ($pizzaType == 'pepperoni') {
            $pizza = new PepperoniPizza($pizzaIngredientFactory);
            $pizza->setName('New York Style Pepperoni Pizza');
        } else {
            throw new \Exception('Wrong Pizza Type');
        }
        return $pizza;
    }
}
