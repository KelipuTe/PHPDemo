<?php

/* 装饰器模式 */

// 定义统一动作的接口
interface DecoratorInterface
{
    public function display();
}

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

class Shirt extends ClothesAbstract
{
    public function display()
    {
        parent::display();
        echo "穿上衬衫。" . PHP_EOL;
    }
}

class Overcoat extends ClothesAbstract
{
    public function display()
    {
        parent::display();
        echo "穿上外套。" . PHP_EOL;
    }
}

class Trousers extends ClothesAbstract
{
    public function display()
    {
        parent::display();
        echo "穿上裤子。" . PHP_EOL;
    }
}

class Shoes extends ClothesAbstract
{
    public function display()
    {
        parent::display();
        echo "穿上鞋子。" . PHP_EOL;
    }
}

class Human implements DecoratorInterface
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function display()
    {
        echo "我是{$this->name}。" . PHP_EOL;
    }
}

/* 测试代码 */

$tom = new Human('Tom');
$tom = new Shirt($tom);
$tom = new Trousers($tom);
$tom = new Overcoat($tom);
$tom = new Shoes($tom);
$tom->display();