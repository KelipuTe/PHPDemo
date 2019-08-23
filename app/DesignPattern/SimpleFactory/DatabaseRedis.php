<?php

namespace App\DesignPattern\SimpleFactory;


require_once 'DatabaseAbstract.php';

class DatabaseRedis extends DatabaseAbstract
{
    protected $key;

    public function __construct()
    {
        $this->connection = 'redis';

        return $this;
    }

    public function select($key)
    {
        $this->key = $key;

        return $this;
    }

    public function get()
    {
        echo "Connect {$this->connection}.
        Run Command: get {$this->key};<br>\n";
    }
}
