<?php

namespace App\DesignPattern\Observer;


require 'EventObserver1.php';
require 'EventObserver2.php';

class Event
{
    private $iObservers;

    public function addObserver(ObserverInterface $ObServer)
    {
        $this->iObservers[] = $ObServer;
    }

    public function notify()
    {
        foreach ($this->iObservers as $Observer) {
            $Observer->update();
        }
    }

    public function trigger()
    {
        $this->notify();
    }
}
