<?php

namespace application\core;

abstract class Controller
{
    protected $route;
    protected $view;
    protected $model;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view  = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    private function loadModel($name)
    {
        $path = 'application\models\\'.ucfirst($name);

        if(class_exists($path)) {
            return new $path();
        }
    }
}