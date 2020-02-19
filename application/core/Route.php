<?php

namespace application\core;

class Route
{
    protected $routes = [];

    public function __construct()
    {
        $config       = require 'application/config/routes.php';
        $this->routes = $config;
    }

    public function start()
    {
        $controllerName = '';
        $actionName     = '';

        $key = $this->match();

        if (isset($this->routes[$key])) {
            $controllerName = $this->routes[$key]['controller'];
            $actionName     = $this->routes[$key]['action'];
        }

        if (!empty($controllerName)) {
            $actionName = strtolower($actionName);
        }

        $controllerFile     = $controllerName . '.php';
        $filepathController = 'application/controllers/' . $controllerFile;

        $path = 'application\controllers\\'.ucfirst($controllerName);
        debug(($path));
        debug(class_exists('application\controllers\Task'));
        if (class_exists($path)) {
            $action = $this->params['action'].'Action';
            if (method_exists($path, $action)) {
                $controller = new $path($this->params);
                $controller->$action();
            } else {
                Route::errors(404);
            }
        }

        if (file_exists($filepathController)) {
            include "application/controllers/$controllerFile";
        } else {
            Route::errors(404);
        }

        $controller = new $controllerName($this->routes[$key]);

        if (method_exists($controller, $actionName)) {

            $controller->$actionName();
        } else {
            Route::errors(404);
        }
    }

    private function match()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $routes = array_filter(
            $routes, function ($value) {
            if (strlen($value) > 0) {
                return $value;
            }
        }
        );

        if (empty($routes)) {
            $routes[0] = '/';
        }

        $routes = implode($routes, '/');

        return $routes;
    }

    public static function errors($code)
    {
        http_response_code($code);
        require 'application/views/errors/'. $code . '.php';
        exit;
    }
}