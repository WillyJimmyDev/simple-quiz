<?php
define('CLASS_DIR','classes/');

function __autoload($classname)
{
    $path = CLASS_DIR . strtolower($classname) . '.class.php';
    require($path);

}
?>