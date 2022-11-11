<?php

namespace Shnopper;

use PDO;

class DB{
    private $query;
    private $preparedParams;
    private $history;
    private $pdo;

    public function __construct($host, $dbname, $user, $pass, $options, $charset="utf8mb4")
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $this->pdo = new PDO($dsn,$user,$pass,$options);
        $this->query = "";
    }

    public function table($name){
        $this->query = "SELECT * FROM " . $name;
    }
    public function where($column, $param, $comparer = "="){
        array_push($this->history, 0);
        $this->query = $this->query . " WHERE " . $column . $comparer . "?";
    }
}