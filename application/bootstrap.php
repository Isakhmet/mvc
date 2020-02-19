<?php

require_once "/var/www/php/mvc/application/dotenv.php";

use application\core\Route;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

(new Route())->start();