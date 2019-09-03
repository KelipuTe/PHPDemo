<?php

require 'NewYorkPizzaStore.php';
require 'ChicagoPizzaStore.php';

use App\DesignPattern\Factory\ChicagoPizzaStore;
use App\DesignPattern\Factory\NewYorkPizzaStore;

$newYorkPizzaStore = new  NewYorkPizzaStore();
$chicagoPizzaStore = new  ChicagoPizzaStore();

$pizza1 = $newYorkPizzaStore->orderPizza('cheese');
echo "KelipuTe ordered {$pizza1->getName()}.\n<br>";

echo "\n<br>";

$pizza2 = $chicagoPizzaStore->orderPizza('cheese');
echo "GH ordered {$pizza2->getName()}.\n<br>";
