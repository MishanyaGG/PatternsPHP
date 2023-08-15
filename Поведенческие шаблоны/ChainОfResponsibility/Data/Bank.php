<?php

namespace Data;

class Bank extends Account{
    protected $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }
}