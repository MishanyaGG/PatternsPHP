<?php

namespace Data;

class VanilCoffee implements CoffeeInterface{
    protected $coffee;

    public function __construct(CoffeeInterface $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 3;
    }

    public function getDesription()
    {
        return $this->coffee->getDesription() . ', vanilla';
    }
}
