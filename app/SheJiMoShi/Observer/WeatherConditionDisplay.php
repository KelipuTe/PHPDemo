<?php

namespace App\DesignPattern\Observer;


require_once 'WeatherObserver.php';
require_once 'WeatherDisplay.php';
require_once 'WeatherSubject.php';

class WeatherConditionDisplay implements WeatherObserver, WeatherDisplay
{
    private $iUniqueId;

    private $iWeatherSubject;

    private $iTemperature;

    private $iHumidity;

    private $iPressure;

    public function __construct($uniqueId, WeatherSubject $weatherSubject)
    {
        $this->iUniqueId = $uniqueId;
        $this->iWeatherSubject = $weatherSubject;
        $weatherSubject->registerObserver($this);
    }

    public function display()
    {
        echo "{$this->iUniqueId} Current Conditions:Temperature={$this->iTemperature};Humidity={$this->iHumidity};Pressure={$this->iPressure};\n<br>";
    }

    public function getUniqueId()
    {
        return $this->iUniqueId;
    }

    public function update(float $temperature, float $humidity, float $pressure)
    {
        $this->iTemperature = $temperature;
        $this->iHumidity = $humidity;
        $this->iPressure = $pressure;
        $this->display();
    }
}