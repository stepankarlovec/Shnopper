<?php

namespace Shnopper;

use PDO;

class Connector{
    private static PDO $pdo;

    public static function connect(){
        $dbConfig = Utils::prepareDB();

        $dsn = "mysql:host=".$dbConfig['host'].";dbname=".$dbConfig['dbname'].";charset=".$dbConfig['charset']."";
        self::$pdo = new PDO($dsn,$dbConfig['user'],$dbConfig['pass']);
        foreach (array_values($dbConfig['options']) as $key => $option){
            self::$pdo->setAttribute(key($option), array_values($option)[0]);
        }
        return self::$pdo;
    }
}