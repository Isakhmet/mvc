<?php

require 'application/library/Dev.php';

use application\core\Route;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

(new Route())->start();