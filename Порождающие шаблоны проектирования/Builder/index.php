<?php

require_once ('Data/Burger.php');
require_once ('Data/BurgerBuilder.php');

$burger = (new BurgerBuilder(14))
    ->addPepperoni()
    ->addLettuce()
    ->addTomato()
    ->addCheese();
