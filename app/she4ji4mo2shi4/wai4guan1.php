<?php

/* 外观模式（Facade）*/

// 外观模式需要 IOC 容器支持
require_once 'kong4zhi4fan3zhuan3.php';

class LogServiceFacade
{
    // 维护 Ioc 容器
    protected static $ioc;

    public static function setFacadeIoc($ioc)
    {
        static::$ioc = $ioc;
    }

    // 返回 LogService 在 Ioc 中的 bind 的 key
    protected static function getFacadeAccessor()
    {
        return 'LogService';
    }

    // php 魔术方法，在静态上下文中调用一个不可访问方法时会被调用
    public static function __callStatic($method, $args)
    {
        $instance = static::$ioc->make(static::getFacadeAccessor());
        // ... 是可变数量的参数列表的语法，表示把 $args（通常是数组）依次赋值给 method() 的参数表
        return $instance->$method(...$args);
    }
}

/* 测试代码 */

$ioc = new IOC();
$ioc->bind('LogInterface', 'DataBaseLog');
$ioc->bind('LogService', 'LogService');

LogServiceFacade::setFacadeIoc($ioc);
LogServiceFacade::saveLog();