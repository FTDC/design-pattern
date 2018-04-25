<?php
/** *
 * 检测一个类是否可以使用 foreach 进行遍历的接口。
 * 无法被单独实现的基本抽象接口。相反它必须由 IteratorAggregate 或 Iterator 接口实现。
 *
 * 这是一个无法在 PHP 脚本中实现的内部引擎接口。IteratorAggregate 或 Iterator 接口可以用来代替它。
 */

//Traversable {
//
//}

$myarray = array('one', 'two', 'three');
$myobj = (object)$myarray;

if (!($myarray instanceof \Traversable)) {
    print "myarray is NOT Traversable";
}
if (!($myobj instanceof \Traversable)) {
    print "myobj is NOT Traversable";
}

foreach ($myarray as $value) {
    print $value.PHP_EOL;
}
foreach ($myobj as $value) {
    print $value.PHP_EOL;
}


