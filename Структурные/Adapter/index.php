<?php

require_once ('Data/LionInterface.php');
require_once ('Data/WildDog.php');
require_once ('Data/WildDogAdapter.php');
require_once ('Data/Hunter.php');

use Data\LionInterface;
use Data\WildDog;
use Data\WildDogAdapter;
use Data\Hunter;

$wildDog = new WildDog();
$wildDogAdapter = new WildDogAdapter($wildDog);

$hunter = new Hunter();
$hunter->hunt($wildDogAdapter);

