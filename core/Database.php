<?php

namespace core;

class Database
{
    public $pdo;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=buildmvc";
            $username = "root";
            $password = "";

            $this->pdo = new \PDO($dsn, $username, $password);
        }catch (\PDOException $e){
            echo "Connected Failed" . $e->getMessage();
        }
    }
}