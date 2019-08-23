<?php

namespace App\DesignPattern\SimpleFactory;


require_once 'DatabaseAbstract.php';

class DatabaseMysql extends DatabaseAbstract
{
    protected $extend;

    protected $table;

    protected $selectField;

    public function __construct()
    {
        $this->connection = 'mysql';
        $this->extend = 'PDO';
        $this->table = 'users';
        $this->selectField = '*';
    }

    public function extend($extend)
    {
        $this->extend = $extend;

        return $this;
    }

    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    public function select($selectField)
    {
        $this->selectField = $selectField;

        return $this;
    }

    public function get()
    {
        echo "Connect {$this->connection} With {$this->extend}.
        Run SQL: select {$this->selectField} from {$this->table};<br>\n";
    }
}
