<?php

namespace App\DesignPattern\Factory;


require_once 'Pizza.php';
require_once 'PizzaIngredientFactory.php';

class VeggiePizza extends Pizza
{
    protected $ingredientFactory;

    public function __construct(PizzaIngredientFactory $ingredientFactory)
    {
        $this->ingredientFactory = $ingredientFactory;
    }

    public function prepare()
    {
        echo "Preparing {$this->name}\n<br>";
        $this->dough = $this->ingredientFactory->createDough();
        $this->sauce = $this->ingredientFactory->createSauce();
        $this->cheese = $this->ingredientFactory->createCheese();
        $this->cheese = $this->ingredientFactory->createVeggies();
        $this->ingredientToString();
    }
}