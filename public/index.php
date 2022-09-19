<?php
use controllers\LoginController;

    require '../config/autoload.php';

   $app = new core\BlogApplication();

   $app->router->get('/', 'home', [new \middlewares\AuthMiddleware()]);
   $app->router->get('/home', 'home');
   $app->router->get('/login', [new LoginController(), 'login']);
   $app->router->post('/login', [new LoginController(), 'handleLogin']);

   $app->run();
