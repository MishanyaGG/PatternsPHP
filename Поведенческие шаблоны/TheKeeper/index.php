<?php

use Data\Editor;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$editor = new Editor();

// Пишем что-нибудь
$editor->type('This is first sentence.');
$editor->type('This is second');

// Сохранение состояния в: This is the first sentence. This is second.
$saved = $editor->save();

$editor->type('And this is third');

//Output: Содержимое до сохранения
echo $editor->getContent() . '<br>'; // This is the first sentence. This is second. And this is third.

$editor->restore($saved);

echo $editor->getContent(); // This is the first sentence. This is second.