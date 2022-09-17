<?php

namespace core;

class BlogApplication {

    public static $ROOT_DIR;
    public static $VIEW_DIR;

    public function __construct()
    {
        static::$ROOT_DIR = dirname(__DIR__);
        static::$VIEW_DIR = static::$ROOT_DIR . '/views';
        $this->router = new Router();
    }

    public function run(){

        $this->router->resolve();
    }

}
