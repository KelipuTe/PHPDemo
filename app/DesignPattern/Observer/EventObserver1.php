<?php

namespace App\DesignPattern\Observer;


require_once 'ObserverInterface.php';

class EventObserver1 implements ObserverInterface
{
    public function update($info = '')
    {
        echo "EventObserver1。\n";
    }
}
