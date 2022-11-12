<?php


class BaseController{
    public $mc;
    public function __construct($mc)
    {
        $this->mc = $mc;
    }

    public function init(){
        echo 'This is base controller speaking';
        //var_dump($this->mc->db->table('users')->fetch());
    }
    public function render(string $file){
        require($file);
    }
}