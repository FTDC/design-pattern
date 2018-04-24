<?php
/** *
 *Tick（时钟周期）是一个在 declare 代码段中解释器每执行 N 条可计时的低级语句就会发生的事件。N 的值是在 declare 中的 directive 部分用 ticks=N 来指定的。
 *
 * 不是所有语句都可计时。通常条件表达式和参数表达式都不可计时。
 *
 * 在每个 tick 中出现的事件是由 register_tick_function() 来指定的。更多细节见下面的例子。注意每个 tick 中可以出现多个事件。
 **/


//declare 结构用来设定一段代码的执行指令。declare 的语法和其它流程控制结构相似：
// 定义执行多少行代码触发tick注册的时间
declare(ticks=3);

$count = 0;

register_tick_function('ticker');
function ticker()
{
    global $count;
    $count++;
    echo $count.PHP_EOL;
}


register_tick_function("say");
function say()
{
    echo "saya".PHP_EOL;
}


$baz = "baz";
$qux = "qux";

//unregister_tick_function("say");

for ($i = 0; $i < 10; $i++) {
    var_dump($i);
}
