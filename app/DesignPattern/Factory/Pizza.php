<?php

namespace App\DesignPattern\Factory;


abstract class Pizza
{
    protected $name;

    protected $dough;

    protected $sauce;

    protected $toppings;

    public function getName()
    {
        return $this->name;
    }

    public function prepare()
    {
        echo "Preparing {$this->name}...\n<br>";
        echo "Tossing dough...\n<br>";
        echo "Adding sauce...\n<br>";
        echo 'Adding toppings:';
        for ($i = 0; $i < count($this->toppings); $i++) {
            echo " {$this->toppings[$i]}";
        }
        echo "\n<br>";
    }

    public function bake()
    {
        echo "Bake for 25 minutes at 350.\n<br>";
    }

    public function cut()
    {
        echo "Cutting the pizza into diagonal slices.\n<br>";
    }

    public function box()
    {
        echo "Place pizza in official PizzaStore box.\n<br>";
    }
}
