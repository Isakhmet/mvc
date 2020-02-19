<?php

namespace application\core;

use application\core\View;

abstract class Controller
{
    protected $route;
    protected $view;

    function __construct($route)
    {
        $this->route = $route;
        $this->view  = new View($route);
    }

    function action()
    {
    }
}