<?php

namespace core;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function get($path, $callback, $middlewares = []){
        $this->routes['get'][$path] = [
            'callback'      => $callback,
            'middlewares'    => $middlewares
        ];
    }

    public function post($path, $callback, $middlewares = []){
        $this->routes['post'][$path] = [
            'callback'      => $callback,
            'middlewares'    => $middlewares
        ];
    }

    public function resolve(){
        $url = $_SERVER['REQUEST_URI'];
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $route_config = $this->routes[$method][$url] ?? null;       // if $view not exists return $view = nul

        $middlewares = $route_config['middlewares'];
        foreach ($middlewares as $middleware){
            $middleware->handle();
        }

        $callback = $route_config['callback'];
        if (is_array($callback)){
            call_user_func($callback);
            return;
        }

        $this->renderView($callback);
    }

    public function renderView($view, $params = []){

        foreach ($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include BlogApplication::$VIEW_DIR."/_layout.php";
        $layout_content = ob_get_clean();

        ob_start();
        if (!file_exists(BlogApplication::$VIEW_DIR."/$view.php")){
            include BlogApplication::$VIEW_DIR."/404.php";
            return;
        }else include BlogApplication::$VIEW_DIR."/$view.php";

        $view_content = ob_get_clean();
        echo str_replace("{{content}}", $view_content, $layout_content);
    }
}