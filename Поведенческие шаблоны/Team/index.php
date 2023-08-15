<?php

use Data\Bulb;
use Data\TurnOn;
use Data\TurnOff;
use Data\RemoteControl;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$turnOn = new TurnOn(new Bulb());
$turnOff = new TurnOff(new Bulb());

$remote = new RemoteControl();
$remote->submit($turnOn);
$remote->submit($turnOff);