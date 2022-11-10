<?php
mb_internal_encoding("UTF-8");
function autoloadFunction(string $trida): void
{
    if (preg_match('/Controller$/', $trida))
        require("app/Controller/" . $trida . ".php");
    else if (preg_match('/Model$/', $trida))
        require("app/Model/" . $trida . ".php");
    else
        require("app/Base/" . $trida . ".php");
}
spl_autoload_register("autoloadFunction");

$mainController = new BaseController();
$mainController->init();

?>