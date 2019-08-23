<?php

namespace App\DesignPattern\Observer;


require_once 'ObserverInterface.php';

class EventObserver2 implements ObserverInterface
{
    public function update($info = '')
    {
        echo "EventObserver2.<br>\n";
    }
}
