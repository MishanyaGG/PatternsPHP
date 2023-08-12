<?php

use Data\SimpleCoffee;
use Data\MilkCoffee;
use Data\WhipCoffee;
use Data\VanilCoffee;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$someCoffee = new SimpleCoffee();

echo $someCoffee->getCost(); echo '<br>';
echo $someCoffee->getDesription(); echo '<br>';

$someCoffee = new MilkCoffee($someCoffee);
echo $someCoffee->getCost(); echo '<br>';
echo $someCoffee->getDesription(); echo '<br>';

$someCoffee = new WhipCoffee($someCoffee);
echo $someCoffee->getCost(); echo '<br>';
echo $someCoffee->getDesription(); echo '<br>';

$someCoffee = new VanilCoffee($someCoffee);
echo $someCoffee->getCost(); echo '<br>';
echo $someCoffee->getDesription(); echo '<br>';