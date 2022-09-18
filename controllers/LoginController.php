<?php

namespace controllers;

use core\Controller;

class LoginController extends Controller
{
    public function login(){
        return $this->renderView('login');
    }

    public function handleLogin(){
        $name = $this->getData()['name'];
        $name = 'Welcome ' . $name;
        return $this->renderView('home', ['username' => $name]);
    }

}