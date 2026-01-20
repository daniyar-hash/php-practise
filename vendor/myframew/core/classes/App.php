<?php

namespace myframew;

class App 
{
    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function getContainer()
    {
        return static::$container;
    }

    public static function get($service):\myframew\Db
    {
        return static::getContainer()->getService($service);
    }
}
