<?php

interface DoorFactoryInterface{
    public function makeDoor() : DoorInterface;
    public function makeFittingExpert() : DoorFittingExpertInterface;
}