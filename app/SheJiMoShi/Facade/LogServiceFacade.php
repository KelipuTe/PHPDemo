<?php

namespace App\SheJiMoShi\Facade;


class LogServiceFacade
{
    protected static $ioc; // 维护 Ioc 容器

    public static function setFacadeIoc($ioc)
    {
        static::$ioc = $ioc;
    }

    // 返回 LogService 在 Ioc 中的 bind 的 key
    protected static function getFacadeAccessor()
    {
        return 'LogService';
    }

    // php 魔术方法，当静态方法被调用时会被触发
    public static function __callStatic($method, $args)
    {
        $instance = static::$ioc->make(static::getFacadeAccessor());

        return $instance->$method(...$args);
    }
}
