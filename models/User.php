<?php

namespace models;

use core\Model;

class User extends Model
{
    public $name;
    public $email;
    public $password;

    public function welcome(){
        return 'Welcome' . $this->name;
    }

    public function getRules()
    {
        return [
            'name' => [static::RULE_REQUIRED],
            'email' => [static::RULE_REQUIRED,static::RULE_EMAIL],
            'password' => [static::RULE_REQUIRED]
        ];
    }
}