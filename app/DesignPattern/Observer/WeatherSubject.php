<?php

namespace App\DesignPattern\Observer;


require_once 'WeatherObserver.php';

interface WeatherSubject
{
    public function registerObserver(WeatherObserver $observer);

    public function removeObserver(WeatherObserver $observer);

    public function notifyObserver();
}
