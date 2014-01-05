<?php

class Highlander
{
    protected static $instance;

    protected function __construct() {}

    public static function getInstance()
    {
        if (! static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}

var_dump(Highlander::getInstance());
var_dump(Highlander::getInstance());
