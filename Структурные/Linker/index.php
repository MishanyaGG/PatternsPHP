<?php

use Data\EmployeeInterface;
use Data\Developer;
use Data\Designer;
use Data\Organization;


// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$jhon = new Developer('Jhon Doe', 12000);
$jane = new Designer('Jane Doe', 15000);

$organization = new Organization();
$organization->addEmployee($jhon);
$organization->addEmployee($jane);

echo "Net salaries: " . $organization->getNetSalaries();
