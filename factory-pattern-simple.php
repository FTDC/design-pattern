<?php
/**
 * Simple Factory-pattern  简单工程模式
 * User: xjin
 * Date: 2015/3/4
 * Time: 22:43
 */

class Fruit {
    // 对象从工厂类返回
}

Class FruitFactory {

    public static function factory() {
        // 返回对象的一个新实例
        return new Fruit();
    }
}

// 调用工厂
$instance = FruitFactory::factory();