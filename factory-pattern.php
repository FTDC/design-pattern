<?php


/**
 * Factory-pattern 工厂模式
 *
 * @abstract 定义一个用于创建对象的接口，让子类决定实例化哪一个类。Factory Method 使一个类的实例化延迟到其子类。
 * @author xjin
 * @version 2015/3/4
 */
class Example {
    
    // 工厂方法
    public static function factory($type)
    {
        // 引入不同的文件 创建不同的对象
        if (include_once 'Drivers/' . $type . '.php')
        {
            $classname = 'Driver_' . $type;
            return new $classname();
        } else
        {
            throw new Exception('Driver not found');
        }
    }
}

// 加载 mysql 驱动
$mysql = Example::factory('MySQL');
// 加载 SQLite 驱动
$sqlite = Example::factory('SQLite');