<?php

class IronDoorFactory implements DoorFactoryInterface{
    public function makeDoor(): DoorInterface
    {
        return new IronDoor();
    }

    public function makeFittingExpert(): DoorFittingExpertInterface
    {
        return new Welder();
    }
}