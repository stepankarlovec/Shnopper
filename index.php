<?php
mb_internal_encoding("UTF-8");
function autoloadFunction(string $trida): void
{
    if (preg_match('/Controller$/', $trida))
        require("app/Controller/" . $trida . ".php");
    else
        require("app/Model/" . $trida . ".php");
}
spl_autoload_register("autoloadFunction");

$mainController = new BaseController();
$mainController->init();

?>