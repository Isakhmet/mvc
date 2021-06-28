<?php

namespace application\controllers;

use application\core\Controller;

class Main extends Controller
{
    function index()
    {
        $this->view->redirect('task/read');
    }
}