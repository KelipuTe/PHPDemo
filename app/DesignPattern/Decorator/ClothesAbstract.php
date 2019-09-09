<?php

namespace App\DesignPattern\Decorator;


require_once 'DecoratorInterface.php';

abstract class ClothesAbstract implements DecoratorInterface
{
    protected $component;

    public function __construct(DecoratorInterface $component)
    {
        $this->component = $component;
    }

    public function display()
    {
        $this->component->display();
    }
}
