<?php

require 'Event.php';

use App\DesignPattern\Observer\Event;
use App\DesignPattern\Observer\EventObserver1;
use App\DesignPattern\Observer\EventObserver2;

$event = new Event();
$event->addObserver(new EventObserver1());
$event->addObserver(new EventObserver2());
$event->trigger();
