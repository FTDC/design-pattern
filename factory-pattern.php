<?php

/**
 * Factory-pattern 工厂模式
 *
 * @abstract 定义一个用于创建对象的接口，让子类决定实例化哪一个类。Factory Method 使一个类的实例化延迟到其子类。
 * @author xjin
 * @version 2015/3/4
 */
class Example{
    
    // The parameterized factory method
    public static function factory($type) 
    {
        // 引入不同的文件  创建不同的对象
        if (include_once 'Drivers/' . $type . '.php') 
        {
            $classname = 'Driver_' . $type;
            return new $classname();
        } else {
            throw new Exception('Driver not found');
        }
    }

}

// Load a MySQL Driver
$mysql = Example::factory('MySQL');
// Load an SQLite Driver
$sqlite = Example::factory('SQLite');