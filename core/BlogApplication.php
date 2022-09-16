<?php

namespace core;

class BlogApplication {

    public static $ROOT_DIR;
    public static $VIEW_DIR;

    public function __construct()
    {
        static::$ROOT_DIR = dirname(__DIR__);
        static::$VIEW_DIR = static::$ROOT_DIR . '/views';
    }

    public function run(){
        $url = $_SERVER['REQUEST_URI'];
        $this->renderView($url);
    }

    public function renderView($view){
        ob_start();
        include static::$VIEW_DIR."/_layout.php";
        $layout_content = ob_get_clean();

        ob_start();
        if (!file_exists(static::$VIEW_DIR."/$view.php")){
            include static::$VIEW_DIR."/404.php";
            return;
        }else include static::$VIEW_DIR."/$view.php";

        $view_content = ob_get_clean();
        echo str_replace("{{content}}", $view_content, $layout_content);
    }

}
