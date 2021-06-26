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
            "$db:host='{$data['host']}';port='{$data['port']}';dbname='{$data['db_name']}'", $data['user'], $data['password']
        );
    }

    public function query($sql, $params = [])
    {
        $prepare = $this->connection->prepare($sql);

        if(!empty($params)) {
            foreach ($params as $key => $param) {
                $prepare->bindValue(':'.$key, $param);
            }
        }

        $prepare->execute();

        return $prepare;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }
}