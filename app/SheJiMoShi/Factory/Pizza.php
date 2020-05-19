<?php

namespace App\DesignPattern\Factory;


abstract class Pizza
{
    protected $name; // 名称

    protected $dough; // 用于制面包和糕点的生面团

    protected $sauce; // 调味汁、酱料

    protected $veggies; // 蔬菜

    protected $cheese; // 干酪、奶酪

    protected $clam; // 蛤蜊

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // 准备原料
    public abstract function prepare();

    // 烘烤
    public function bake()
    {
        echo "Bake for 25 minutes at 350.\n<br>";
    }

    // 切割
    public function cut()
    {
        echo "Cutting the pizza into diagonal slices.\n<br>";
    }

    // 装盒
    public function box()
    {
        echo "Place pizza in official PizzaStore box.\n<br>";
    }

    // 原料清单
    public function ingredientToString()
    {
        echo "Ingredient:{$this->dough},{$this->sauce},{$this->veggies},{$this->cheese},{$this->clam}.\n<br>";
    }
}
