<?php

require 'Hui.php';
require 'Overcoat.php';
require 'Trousers.php';
require 'Shoes.php';

use App\DesignPattern\Decorator\Hui;
use App\DesignPattern\Decorator\Overcoat;
use App\DesignPattern\Decorator\Trousers;
use App\DesignPattern\Decorator\Shoes;

$hui = new Hui('惠');
$huiAddOvercoat = new Overcoat($hui);
$huiAddTrousers = new Trousers($huiAddOvercoat);
$huiAddShoes = new Shoes($huiAddShoes);
$huiAddShoes->display();
