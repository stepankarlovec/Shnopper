<?php


class BaseController{
    public function __construct()
    {
    }
    public function init(){
        //echo 'This is base controller speaking';
        //var_dump($this->mc->db->table('users')->fetch());
        //BaseModel::logStrucutre();
        UsersModel::logStrucutre();
    }
    public function render(string $file){
        require($file);
    }
}