<?php

namespace core;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function get($path, $view){
        $this->routes['get'][$path] = $view;
    }

    public function post($path, $view){
        $this->routes['post'][$path] = $view;
    }

    public function resolve(){
        $url = $_SERVER['REQUEST_URI'];
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $view = $this->routes[$method][$url] ?? null;       // if $view not exists return $view = nul

        if (is_array($view)){
            call_user_func($view);
            return;
        }

        $this->renderView($view);
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