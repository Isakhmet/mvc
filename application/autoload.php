<?php
ini_set('display_errors', 1);

require_once "application/dotenv.php";

(new Dotenv())->load(__DIR__);

require_once "application/bootstrap.php";