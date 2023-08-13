<?php

use Data\Computer;
use Data\ComputerFacade;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$computer = new ComputerFacade(new Computer());

$computer->turnOn();
echo '<br>';
$computer->turnOff();
