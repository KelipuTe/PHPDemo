<?php

require 'Hui.php';
require 'Overcoat.php';
require 'Trousers.php';
require 'Shoes.php';

use App\DesignPattern\Decorator\Hui;
use App\DesignPattern\Decorator\Overcoat;
use App\DesignPattern\Decorator\Shoes;
use App\DesignPattern\Decorator\Trousers;

$hui = new Hui('惠');
$overcoat = new Overcoat($hui);
$trousers = new Trousers($overcoat);
$shoes = new Shoes($trousers);
$shoes->display();
