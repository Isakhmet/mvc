<?php

use application\core\Controller;

class Main extends Controller
{
    function index()
    {
        $this->view->generate('Main.php', 'template');
    }
}