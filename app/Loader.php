<?php 

spl_autoload_register(function ($class_name) {
    $f = (__DIR__ . '/' . $class_name . '.php');

    if(!is_file($f)) {
        throw new Exception('Fatal Error (Autoloader) ' . $class_name);
    }

    require_once $f;
});
