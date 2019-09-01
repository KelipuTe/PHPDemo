<?php

require 'WeatherData.php';
require 'WeatherConditionDisplay.php';

use App\DesignPattern\Observer\WeatherConditionDisplay;
use App\DesignPattern\Observer\WeatherData;

$weatherData = new WeatherData();

$currentDisplay1 = new WeatherConditionDisplay('display1', $weatherData);
$currentDisplay2 = new WeatherConditionDisplay('display2', $weatherData);
$currentDisplay3 = new WeatherConditionDisplay('display3', $weatherData);

$weatherData->setMeasurements(1, 2, 3);
$weatherData->setMeasurements(4, 5, 6);

