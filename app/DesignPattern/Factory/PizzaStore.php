<?php

namespace App\DesignPattern\Factory;


abstract class PizzaStore
{
    public function orderPizza(string $pizzaType)
    {
        $pizza = $this->createPizza($pizzaType);

        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();

        return $pizza;
    }

    protected abstract function createPizza(string $pizzaType);
}
