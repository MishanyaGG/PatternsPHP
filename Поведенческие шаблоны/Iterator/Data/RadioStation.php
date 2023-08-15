<?php

namespace Data;

class RadioStation{
    protected $frequecy;

    public function __construct($frequecy)
    {
        $this->frequecy = $frequecy;
    }

    public function getFrequency(){
        return $this->frequecy;
    }
}