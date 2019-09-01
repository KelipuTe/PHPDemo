<?php

namespace App\DesignPattern\Observer;


require_once 'WeatherSubject.php';
require_once 'WeatherObserver.php';

class WeatherData implements WeatherSubject
{
    private $iObserverList;

    private $iTemperature;

    private $iHumidity;

    private $iPressure;

    public function __construct()
    {
        $this->iObserverList = [];
    }

    public function registerObserver(WeatherObserver $observer)
    {
        $this->iObserverList[$observer->getUniqueId()] = $observer;
    }

    public function removeObserver(WeatherObserver $observer)
    {
        unset($this->iObserverList[$observer->getUniqueId()]);
    }

    public function notifyObserver()
    {
        foreach ($this->iObserverList as $item) {
            $item->update($this->iTemperature, $this->iHumidity, $this->iPressure);
        }
    }

    public function setMeasurements(float $temperature, float $humidity, float $pressure)
    {
        $this->iTemperature = $temperature;
        $this->iHumidity = $humidity;
        $this->iPressure = $pressure;
        $this->measurementsChanged();
    }

    public function measurementsChanged()
    {
        $this->notifyObserver();
    }
}
