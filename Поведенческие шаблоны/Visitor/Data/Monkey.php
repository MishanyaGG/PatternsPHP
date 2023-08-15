<?php

namespace Data;

class Monkey implements AnimalInterface{
    public function shout(){
        echo 'Ooh oo aa aa!';
    }

    public function accept(AnimalOperationInrerface $operation)
    {
        $operation->visitMonkey($this);
    }
}
