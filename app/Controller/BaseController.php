<?php
class BaseController{
    public function init(){
        echo 'This is base controller speaking';
    }
    public function render(string $file){
        require($file);
    }
}