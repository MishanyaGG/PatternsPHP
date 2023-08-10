<?php

class WoodenDoorFactory implements DoorFactoryInterface {
    public function makeDoor(): DoorInterface
    {
        return  new WoodenDoor();
    }

    public function makeFittingExpert(): DoorFittingExpertInterface
    {
        return new Carpenter();
    }
}