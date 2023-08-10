<?php

final class President{
    private static $instance;

    private function __construct(){}

    private function __clone(){}

    public function __wakeup(){}

    public static function getInstance() : President{
        if (!self::$instance){
            self::$instance = new self();
        }

        return self::$instance;
    }
}