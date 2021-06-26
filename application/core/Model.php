<?php

namespace application\core;

use application\library\DataBase;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}