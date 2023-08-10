<?php

class WoodenDoor implements DoorInterface
{

    protected $widht;
    protected $height;

    public function __construct($widht, $height)
    {
        $this->height = $height;
        $this->widht = $widht;
    }

    public function getWidth()
    {
        return $this->widht;
    }

    public function getHeight()
    {
        return $this->height;
    }
}