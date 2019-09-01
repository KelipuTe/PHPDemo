<?php

namespace App\DesignPattern\Observer;


interface WeatherObserver
{
    public function getUniqueId();

    public function update(float $temperature, float $humidity, float $pressure);
}
