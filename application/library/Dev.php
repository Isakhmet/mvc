<?php

ini_set('display_errors', 1);
require_once "./application/dotenv.php";
(new Dotenv())->load(__DIR__);

function debug($str) {
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}
