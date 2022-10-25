<?php
function loadClass(string $class) : void
{
    require("class/$trida.php");
}
spl_autoload_register("nactiTridu");


?>