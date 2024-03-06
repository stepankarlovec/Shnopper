<?php

use Shnopper\Connector;
use Shnopper\Database;

abstract class Model {

    private Connector $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create(array $fields){

    }

    public static function getTableStructure(){
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $callerClass = $trace[1]['class'];
        $cc = str_replace("Model","", basename($callerClass, 'Model.php'));
        $res = Database::table($cc)->getTableStructure();
        var_dump($res);
    }
}