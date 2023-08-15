<?php

use Data\Sorter;
use Data\BubbleSortStrategy;
use Data\QuickSortStrategy;

// Автозагрузчик
spl_autoload_register(function ($className) {
    $fileName = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($fileName)) {
        require_once $fileName;
    }
});

$dataset = [1,5,4,3,2,8];

$sorter = new Sorter(new BubbleSortStrategy());
$sorter->sort($dataset);

$sorter = new Sorter(new QuickSortStrategy());
$sorter->sort($dataset);