<?php

use Shnopper\Utils;

try {
    //$configDBdata = Utils::prepareDB();
    //$db = new Connector($configDBdata['host'], $configDBdata['dbname'], $configDBdata['user'], $configDBdata['pass'], $configDBdata['options'], $configDBdata['charset']);
    //$mc = new Manager($db);
}catch (Exception $e){
    Utils::displayException($e);
}
?>