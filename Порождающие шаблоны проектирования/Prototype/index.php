<?php

require_once ('Sheep.php');

$original = new Sheep('Jolly');

echo $original->getName();
echo $original->getCategory();
echo '<br>';

$cloned = clone $original;

$cloned->setName('Dolly');

echo $cloned->getName();
echo $cloned->getCategory();