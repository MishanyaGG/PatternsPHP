<?php

use Data\ChatRoom;
use Data\User;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$mediator = new ChatRoom();

$jhon = new User('John Doe', $mediator);
$jane = new User('Jane Doe',$mediator);

$jhon->send('Hi there! <br>');
$jane->send('Hey!');