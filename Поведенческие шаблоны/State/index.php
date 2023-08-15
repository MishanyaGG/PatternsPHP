<?php

use Data\TextEditor;
use Data\LowerCase;
use Data\UpperCase;
use Data\DefaultModel;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$editor = new TextEditor(new DefaultModel());

$editor->type('First line'); echo '<br>';

$editor->setState(new UpperCase());

$editor->type('Second line'); echo '<br>';
$editor->type('Thrid line'); echo '<br>';

$editor->setState(new LowerCase());

$editor->type('Fourth line'); echo '<br>';
$editor->type('Fifth line');