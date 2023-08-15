<?php

namespace Data;

class PayPal extends Account {
    protected $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }
}
