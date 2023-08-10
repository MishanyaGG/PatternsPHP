<?php

require_once ('Data/DoorInterface.php');
require_once ('Data/DoorFactoryInterface.php');
require_once ('Data/DoorFittingExpertInterface.php');
require_once ('Data/WoodenDoor.php');
require_once ('Data/Carpenter.php');
require_once ('Data/IronDoor.php');
require_once ('Data/IronDoorFactory.php');
require_once ('Data/Welder.php');
require_once ('Data/WoodenDoorFactory.php');

$woodenFactory = new WoodenDoorFactory();

$door = $woodenFactory->makeDoor();
$expert = $woodenFactory->makeFittingExpert();

$ironFactory = new IronDoorFactory();

$door = $ironFactory->makeDoor();
$expert = $ironFactory->makeFittingExpert();

$door->getDescription();
$expert->getDescription();