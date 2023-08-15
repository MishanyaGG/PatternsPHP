<?php

namespace Data;

class Security{
    protected $door;

    public function __construct(DoorInterface $door)
    {
        $this->door = $door;
    }

    public function authenticate($password){
        return $password === '$ecr@t';
    }

    public function open($password){
        if ($this->authenticate($password)){
            $this->door->open();
        } else{
            echo 'Big no! It ain`t possible';
        }
    }

    public function close(){
        $this->door->close();
    }
}
