<?php

namespace Data;

class TeaMaker{
    protected $availablTea = [];

    public function make($preference){
        if(empty($this->availablTea[$preference])){
            $this->availablTea[$preference] = new KarakTea();
        }

        return $this->availablTea[$preference];
    }
}