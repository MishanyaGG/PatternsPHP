<?php

namespace Data;

class WhipCoffee implements CoffeeInterface{
    protected $coffee;

    public function __construct(CoffeeInterface $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 5;
    }

    public function getDesription()
    {
        return $this->coffee->getDesription() . ', whip';
    }
}