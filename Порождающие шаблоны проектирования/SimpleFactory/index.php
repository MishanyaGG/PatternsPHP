<?php

require_once('Factory/DoorFactory.php');
require_once('Factory/DoorInterface.php');
require_once('Factory/WoodenDoor.php');

$door = DoorFactory::makeDoor(100,200);

echo 'Width: '. $door->getWidth();
echo 'Height: '. $door->getHeight();
