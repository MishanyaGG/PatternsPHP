<?php

namespace Data;

interface AnimalInterface{
    public function accept(AnimalOperationInrerface $operation);
}