<?php

use Shnopper\DB;

class Manager{

    public $db;

    /**
     * Put every single class into dis contructor
     * Manager constructor.
     * @param DB $db
     */
    public function __construct(DB $db,)
    {
        $this->db = $db;
    }
}