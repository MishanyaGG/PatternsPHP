<?php

namespace Data;

use Exception;

abstract class Account{
    protected $successor;
    protected $balance;

    public function setNext(Account $account){
        $this->successor = $account;
    }

    public function pay($amountToPay){
        if($this->canPay($amountToPay)){
            echo sprintf('Paid %s using %s <br>',$amountToPay, get_called_class());
        } elseif ($this->successor){
            echo sprintf('Cannot pay using %s. Proceeding.. <br>', get_called_class());
            $this->successor->pay($amountToPay);
        } else{
            throw new Exception('None of the accounts have enough balance');
        }
    }

    public function canPay($amount) : bool{
        return $this->balance >= $amount;
    }
}