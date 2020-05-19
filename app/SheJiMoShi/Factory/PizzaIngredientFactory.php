<?php

namespace App\DesignPattern\Factory;


interface PizzaIngredientFactory
{
    public function createDough();

    public function createSauce();

    public function createVeggies();

    public function createCheese();

    public function createClam();

    public function createPepperoni();
}
