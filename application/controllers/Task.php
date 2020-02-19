<?php

namespace application\controllers;

use \application\core\Controller;
use \application\library\DataBase;

class Task extends Controller
{
    public function create()
    {
        $db = new DataBase();
        $result = $db->query('select * from users');
        die(var_dump($result));
        $this->view->render('Task', []);
    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}