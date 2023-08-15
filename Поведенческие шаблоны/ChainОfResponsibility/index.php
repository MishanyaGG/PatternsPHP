<?php

use Data\Bank;
use Data\PayPal;
use Data\Bitcoin;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

// Сделаем такую цепочку
//      $bank->$paypal->$bitcoin
//
// Приоритет у банка
//      Если банк не может оплатить, переходим к Paypal
//      Если Paypal не может, переходим к Bitcoin

$bank = new Bank(100);
$paypal = new PayPal(200);
$bitcoin = new Bitcoin(300);

$bank->setNext($paypal);
$paypal->setNext($bitcoin);

// Начнём с банка
$bank->pay(259);

//Data\Bank Object (
//    [successor:protected] => Data\PayPal Object (
//        [successor:protected] => Data\Bitcoin Object (
//            [successor:protected] => [balance:protected] => 300
//        ) [balance:protected] => 200
//    ) [balance:protected] => 100 )

// Выходной вид
// ==============
// Нельзя оплатить с помощью банка. Обрабатываю...
// Нельзя оплатить с помощью Paypal. Обрабатываю...
// Оплачено 259 с помощью Bitcoin!