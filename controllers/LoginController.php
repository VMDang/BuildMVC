<?php

namespace controllers;

use models\User;
use core\Controller;

class LoginController extends Controller
{
    public function login(){
        return $this->renderView('login');
    }

    public function handleLogin(){

        $user = new User();
        $user->loadData($this->getData());
        return $this->renderView('home', ['user' => $user]);
    }

    public function register()
    {
        $user = new User();
        $user->loadData($this->getData());
        $user->validate();
        if (count($user->errors) > 0) {
            return $this->renderView('register', ['user' => $user, 'errors' => $user->errors]);
        }
        if (!$user->save()) {
            $user->errors[] = 'database failure';
            return $this->renderView('register', ['user' => $user, 'errors' => $user->errors]);
        }
        return $this->renderView('home', ['user' => $user]);
    }
}