<?php

/**
 * Factory-pattern  工厂模式
 * User: xjin
 * Date: 2015/3/4
 * Time: 22:43
 */
class Example
{
    // The parameterized factory method
    public static function factory($type)
    {
        if (include_once 'Drivers/' . $type . '.php') {
            $classname = 'Driver_' . $type;
            return new $classname;
        } else {
            throw new Exception('Driver not found');
        }
    }
}

// Load a MySQL Driver
$mysql = Example::factory('MySQL');
// Load an SQLite Driver
$sqlite = Example::factory('SQLite');