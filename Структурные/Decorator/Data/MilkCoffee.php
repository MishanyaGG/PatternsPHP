<?php

namespace Data;

class MilkCoffee implements CoffeeInterface{
    protected $coffee;

    public function __construct(CoffeeInterface $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 2;
    }

    public function getDesription()
    {
        return $this->coffee->getDesription(). ', milk';
    }
}
