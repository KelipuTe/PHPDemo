<?php

namespace App\DesignPattern\Decorator;


require_once 'DecoratorInterface.php';

class Clothes implements DecoratorInterface
{
    private $iComponent;

    public function __construct(DecoratorInterface $component)
    {
        $this->iComponent = $component;
    }

    public function display()
    {
        $this->iComponent->display();
    }
}
