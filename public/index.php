<?php
    require '../config/autoload.php';

   $app = new core\BlogApplication();

   $app->router->get('/', 'home');
   $app->router->get('/home', 'home');
//   $app->router->get('/login', 'login');

   $app->run();
