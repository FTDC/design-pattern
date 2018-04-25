<?php
/**
 * 生成器
 *
 * Generator 对象不能通过 new 实例化.
 *
 * Generator implements Iterator {
 *
 * public mixed current(void)
 * public mixed key(void)
 * public void next(void)
 * public void rewind(void)
 * public mixed send(mixed $value )
 * public void throw (Exception $exception )
 * public bool valid(void)
 * public void __wakeup(void)
 * }
 */

function fib($n)
{
    $cur = 1;
    $prev = 0;
    for ($i = 0; $i < $n; $i++) {
        yield $cur;

        $temp = $cur;
        $cur = $prev + $cur;
        $prev = $temp;
    }
}


$fibs = fib(9);
foreach ($fibs as $fib) {
    echo " ".$fib;
}


function printer()
{
    while (true) {
        $string = yield;
        echo $string;
    }
}


$printer = printer();
$printer->send('Hello world!');


function Gen()
{
    yield 'key' => 'value';
}


$gen = Gen();
echo "{$gen->key()} => {$gen->current()}";