<?php

namespace App\DesignPattern\Decorator;


require_once 'Decorator.php';

class Clothes implements Decorator
{
    private $iComponent;

    public function __construct(Decorator $component)
    {
        $this->iComponent = $component;
    }

    public function display()
    {
        $this->iComponent->display();
    }
}
