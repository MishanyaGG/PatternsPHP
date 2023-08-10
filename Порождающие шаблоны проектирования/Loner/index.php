<?php

require_once ('President.php');

$president1 = President::getInstance();
$president2 = President::getInstance();

var_dump($president1 === $president2);
