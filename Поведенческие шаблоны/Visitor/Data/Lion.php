<?php

namespace Data;

class Lion implements AnimalInterface{
    public function shout(){
        echo 'Roaaar!';
    }

    public function accept(AnimalOperationInrerface $operation)
    {
        $operation->visitLion($this);
    }
}