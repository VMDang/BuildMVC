<?php
use controllers\LoginController;
use middlewares\AuthMiddleware;

    require '../config/autoload.php';

   $app = new core\BlogApplication();

   $app->router->get('/', 'home', [new AuthMiddleware()]);
   $app->router->get('/home', 'home', [new AuthMiddleware()]);
   $app->router->get('/register', 'register');
   $app->router->post('/register', [new LoginController(), 'register']);
   $app->router->get('/login', [new LoginController(), 'login']);
   $app->router->post('/login', [new LoginController(), 'handleLogin']);

   $app->run();
