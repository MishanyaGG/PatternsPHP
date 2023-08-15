<?php

namespace Data;

class Dolphin implements AnimalInterface{
    public function speak(){
        echo 'Tuut tuttu tuutt!';
    }

    public function accept(AnimalOperationInrerface $operation)
    {
        $operation->visitDolphin($this);
    }
}