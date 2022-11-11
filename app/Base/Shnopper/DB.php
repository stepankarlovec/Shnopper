<?php

namespace Shnopper;

use PDO;

class DB{
    private $pdo;

    public function __construct($host, $dbname, $user, $pass, $options, $charset="utf8mb4")
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $this->pdo = new PDO($dsn,$user,$pass,$options);
    }

    public function table(){

    }
}