<?php

/* 观察者模式 */

// 天气数据观察者接口
interface WeatherObserver
{
    // 获取唯一识别号
    public function getUniqueId();

    // 数据更新时的响应
    public function update(float $temperature, float $humidity, float $pressure);
}

// 天气数据主体接口
interface WeatherSubject
{
    // 注册观察者
    public function registerObserver(WeatherObserver $observer);

    // 移除观察者
    public function removeObserver(WeatherObserver $observer);

    // 通知观察者
    public function notifyObserver();
}

// 天气数据主体（被观察者）
class WeatherData implements WeatherSubject
{
    // 观察者列表
    protected $observerList;

    // 气温
    protected $temperature;

    // 湿度
    protected $humidity;

    // 气压
    protected $pressure;

    public function __construct()
    {
        $this->observerList = [];
    }

    public function registerObserver(WeatherObserver $observer)
    {
        $this->observerList[$observer->getUniqueId()] = $observer;
    }

    public function removeObserver(WeatherObserver $observer)
    {
        unset($this->observerList[$observer->getUniqueId()]);
    }

    public function notifyObserver()
    {
        foreach ($this->observerList as $item) {
            $item->update($this->temperature, $this->humidity, $this->pressure);
        }
    }

    // 天气测量数值发生变化，通知观察者
    public function measurementsChanged()
    {
        $this->notifyObserver();
    }

    // 设置天气测量数值
    public function setMeasurements(float $temperature, float $humidity, float $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->measurementsChanged();
    }
}

// 天气数据展示（观察者）
class WeatherConditionDisplay implements WeatherObserver
{
    protected $uniqueId;

    protected $weatherSubject;

    protected $temperature;

    protected $humidity;

    protected $pressure;

    public function __construct($uniqueId, WeatherSubject $weatherSubject)
    {
        $this->uniqueId = $uniqueId;
        $this->weatherSubject = $weatherSubject;
        $weatherSubject->registerObserver($this);
    }

    public function display()
    {
        echo "{$this->uniqueId} Current Conditions:Temperature={$this->temperature};Humidity={$this->humidity};Pressure={$this->pressure};" . PHP_EOL;
    }

    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    public function update(float $temperature, float $humidity, float $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->display();
    }
}

/* 测试代码 */

$weatherData = new WeatherData();
$conditionDisplay1 = new WeatherConditionDisplay('display1', $weatherData);
$conditionDisplay2 = new WeatherConditionDisplay('display2', $weatherData);
$conditionDisplay3 = new WeatherConditionDisplay('display3', $weatherData);
$weatherData->setMeasurements(1, 2, 3);
$weatherData->setMeasurements(4, 5, 6);