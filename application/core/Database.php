<?php

namespace application\core;

class Database
{
    protected $connection;
    protected $dataConnect;
    protected $type;

    public function __construct()
    {
        $config = require_once "/var/www/php/mvc/application/config/database.php";
        $this->type = getenv('DB_CONNECTION');
        $this->dataConnect = $config['connections'][$this->type];
    }

    public function getConnection(){

        $dsn = "$this->type:
                host={$this->dataConnect['host']};
                port={$this->dataConnect['port']};
                dbname={$this->dataConnect['db_name']};
                user={$this->dataConnect['user']};
                password={$this->dataConnect['password']}";

        $pdo = new PDO($dsn, $this->dataConnect['user'], $this->dataConnect['password']);

        return $pdo;
    }
}