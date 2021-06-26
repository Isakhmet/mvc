<?php

namespace application\core;

class Route
{
    protected $routes = [];

    public function __construct()
    {
        $this->routes = require 'application/config/routes.php';
    }

    public function start()
    {
        try {
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
            $path               = 'application\controllers\\' . ucfirst($controllerName);

            if (class_exists($path)) {
                if (method_exists($path, $actionName)) {
                    $controller = new $path($this->routes[$key]);
                    $controller->$actionName();
                } else {
                    Route::errors(404);
                }
            }else{
                Route::errors(404);
            }
        }catch (\Exception $exception)
        {
            Route::errors(500, $exception->getMessage());
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

        $routes = implode('/', $routes);

        return $routes;
    }

    public static function errors($code, $message = '')
    {
        http_response_code($code);
        include 'application/views/errors/' . $code . '.php';
        exit;
    }
}