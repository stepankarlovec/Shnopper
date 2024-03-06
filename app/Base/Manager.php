<?php

use Shnopper\Connector;

class Manager{

    public $db;

    /**
     * Put every single class into dis contructor
     * Manager constructor.
     * @param Connector $db
     */
    public function __construct(Connector $db,)
    {
        $this->db = $db;
    }
}