<?php

namespace App\DesignPattern\SimpleFactory;


require 'DatabaseMysql.php';
require 'DatabaseRedis.php';

class DataBaseFactory
{
    public static function makeConnection($classification)
    {
        switch ($classification) {
            case 'mysql':
                return new DatabaseMysql();
            case 'redis':
                return new DatabaseRedis();
            default:
                return null;
        }
    }
}
