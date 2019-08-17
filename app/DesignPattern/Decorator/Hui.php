<?php

namespace App\DesignPattern\Decorator;


require_once 'DecoratorInterface.php';

class Hui implements DecoratorInterface
{
    private $iName;

    public function __construct($name)
    {
        $this->iName = $name;
    }

    public function display()
    {
        echo "我是{$this->iName}。\n";
    }
}
