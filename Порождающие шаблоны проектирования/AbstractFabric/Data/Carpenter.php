<?php

class Carpenter implements DoorFittingExpertInterface{
    public function getDescription()
    {
        echo 'I can only fit wooden doors';
    }
}