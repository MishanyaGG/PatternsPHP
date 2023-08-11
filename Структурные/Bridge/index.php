<?php

use Data\DarkTheme;
use Data\About;
use Data\Careers;
use Data\LightTheme;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$darkTheme = new DarkTheme();
$whiteTheme = new LightTheme();

$about = new About($darkTheme);
$careers = new Careers($whiteTheme);

echo $about->getContent();
echo $careers->getContent();