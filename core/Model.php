<?php

namespace core;

abstract class Model
{
    public function loadData($data){

        foreach ($data as $key => $value){
            if (property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
    }

    const RULE_REQUIRED = 'required';
    const RULE_EMAIL = 'email';

    public $errors = [];

    abstract function getRules();

    public function validate(){

        foreach ($this->getRules() as $attr => $rules){
            $value = $this->{$attr};

            foreach ($rules as $rule_name){
                if ($rule_name == static::RULE_REQUIRED && !$value){
                    $this->addErrorByRule($attr, static::RULE_REQUIRED);
                }
                if ($rule_name == static::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->addErrorByRule($attr, static::RULE_EMAIL);
                }
            }
        }
    }

    private function addErrorByRule($attr, $rule){
        if ($rule === static::RULE_REQUIRED){
            $this->errors[] = "$attr: this field is required";
        }
        if ($rule === static::RULE_EMAIL){
            $this->errors[] = "$attr: this field is an email";
        }
    }

    protected abstract function table();
    protected abstract function columns();

    public function save(){
        $table = $this->table();
        $columns = $this->columns();
        $values = array_map(function ($c){
            return $this->{$c};
            }, $columns);
        $values = array_map(function ($v){
            return "'$v'";
        }, $values);

        $columns = implode(',', $columns);
        $values = implode(',', $values);
        $query = "INSERT INTO $table($columns) VALUES ($values)";

        return BlogApplication::$app->db->pdo->exec($query);
    }
}