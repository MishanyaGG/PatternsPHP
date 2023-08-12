<?php

namespace Data;

class SimpleCoffee implements CoffeeInterface{
    public function getCost()
    {
        return 10;
    }

    public function getDesription()
    {
        return 'Simple coffee';
    }
}
