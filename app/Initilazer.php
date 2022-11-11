<?php
use Shnopper\DB;
use Shnopper\Utils;

try {
    $configDBdata = Utils::prepareDB();
    $db = new DB($configDBdata['host'], $configDBdata['dbname'], $configDBdata['user'], $configDBdata['pass'], $configDBdata['options'], $configDBdata['charset']);
    $mc = new Manager($db);
}catch (Exception $e){
    Utils::displayException($e);
}
?>