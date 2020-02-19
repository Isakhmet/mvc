<?php

namespace application\library;

use PDO;

class DataBase
{
    protected $connection;

    public function __construct()
    {
        $config = require 'application/config/database.php';
        $db     = getenv('DB_CONNECTION');
        $data   = $config['connections'][$db];

        $this->connection = new PDO(
            "$db:host='{$data['host']}';dbname='{$data['db_name']}'", $data['user'], $data['password']
        );
    }

    public function query($sql)
    {
        $this->connection->query($sql);
    }
}