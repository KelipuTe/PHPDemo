<?php

namespace App\DesignPattern\SimpleFactory;


abstract class DatabaseAbstract
{
    protected $connection;

    public function connection($connection)
    {
        return $this->connection = $connection;
    }

    abstract public function get();
}
