<?php
class BaseController{
    public function init(){
        Utils::getConfig();
        echo 'gay';
    }
    public function render(string $file){
        require($file);
    }
}