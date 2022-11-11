<?php
namespace Shnopper;

class Selection{

    public $result;

    public $table;

    public $params;

    public $conditions;

    public function __construct($result, $table, $params, $conditions)
    {
        $this->result = $result;
        $this->table = $table;
        $this->params = $params;
        $this->conditions = $conditions;
    }
}