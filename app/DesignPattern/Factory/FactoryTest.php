<?php

require 'NewYorkPizzaStore.php';
// require 'ChicagoPizzaStore.php';
// require 'CaliforniaPizzaStore.php';

use App\DesignPattern\Factory\NewYorkPizzaStore;
// use App\DesignPattern\Factory\ChicagoPizzaStore;
// use App\DesignPattern\Factory\CaliforniaPizzaStore;

$newYorkPizzaStore = new  NewYorkPizzaStore();
// $chicagoPizzaStore = new  ChicagoPizzaStore();
// $californiaPizzaStore = new  CaliforniaPizzaStore();

$pizza1 = $newYorkPizzaStore->orderPizza('cheese');
echo "KelipuTe ordered {$pizza1->getName()}.\n<br>";

// echo "\n<br>";

// $pizza2 = $chicagoPizzaStore->orderPizza('cheese');
// echo "KelipuTe ordered {$pizza2->getName()}.\n<br>";

// echo "\n<br>";

// $pizza3 = $californiaPizzaStore->orderPizza('cheese');
// echo "KelipuTe ordered {$pizza3->getName()}.\n<br>";
