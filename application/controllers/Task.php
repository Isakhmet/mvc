<?php

namespace application\controllers;

use \application\core\Controller;
use \application\library\DataBase;

class Task extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function read()
    {
        $params = [
            'tasks' => $this->model->getTasks()
        ];
        //die(var_dump($params));
        $this->view->render('Task', $params);
    }

    public function create()
    {
    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}