<?php
/**
 * 用于代表 匿名函数 的类.
 *
 * 匿名函数（在 PHP 5.3 中被引入）会产生这个类型的对象。在过去，这个类被认为是一个实现细节，但现在可以依赖它做一些事情。自 PHP 5.4 起，这个类带有一些方法，允许在匿名函数创建后对其进行更多的控制。
 *
 * 除了此处列出的方法，还有一个 __invoke 方法。这是为了与其他实现了 __invoke()魔术方法 的对象保持一致性，但调用匿名函数的过程与它无关。
 */

//class Closure
//{
//
//}

function createGreeter($who)
{
    return function () use ($who) {
        echo "Hello $who";
    };
}

$greeter = createGreeter("World");
$greeter(); // Hello World

