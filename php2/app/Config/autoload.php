<?php
spl_autoload_register(function($classname){
    $classname = lcfirst($classname);
    $classname = str_replace("\\", DIRECTORY_SEPARATOR, $classname);
    $classname .= ".php";
    // echo $classname;
    require_once $classname;
});