<?php

namespace middlewares;

use core\BlogApplication;
use core\Middleware;

class AuthMiddleware extends Middleware
{
    public function handle()
    {
        if (BlogApplication::$app->isLogin()){
            header('location: /login');
        }
    }
}