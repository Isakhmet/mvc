<?php

namespace application\core;

class View
{
    private $path;
    private $layout = 'default';
    private $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path  = strtolower($route['controller']) . '/' . strtolower($route['action']);
    }

    public function render($title, $params = [])
    {
        try {
            $is_admin = $_SESSION['is_admin'] ?? false;
            extract($params);

            if (file_exists('application/views/' . $this->path . '.php')) {
                ob_start();
                require 'application/views/' . $this->path . '.php';
                $content = ob_get_clean();
                require 'application/views/layouts/' . $this->layout . '.php';
            } else {
                Route::errors(404);
            }
        } catch (\Exception $exception) {
            Route::errors(500, [
                'message' => $exception->getMessage(),
                'line'    => $exception->getLine(),
                'file'    => $exception->getFile(),
            ]);
        }

    }

    public function redirect($url)
    {
        header('location: ' . $url);
        exit;
    }
}