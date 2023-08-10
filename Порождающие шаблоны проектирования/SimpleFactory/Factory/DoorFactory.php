<?php

class DoorFactory{
    public static function makeDoor($width, $height){
        return new WoodenDoor($width,$height);
    }
}