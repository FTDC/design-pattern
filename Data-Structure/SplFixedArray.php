<?php
/**
 * SplFixedArray类提供了数组的主要功能。
 * SplFixedArray和普通PHP数组之间的主要区别在于，SplFixedArray是固定长度的，并且只允许在范围内的整数作为索引。
 *
 * 优点是它允许更快的数组实现。
 */

$array = new SplFixedArray(5);

$array[1] = 2;
$array[4] = "foo";

var_dump($array[0]); // NULL
var_dump($array[1]); // int(2)

var_dump($array["4"]); // string(3) "foo"

// Increase the size of the array to 10
$array->setSize(10);

$array[9] = "asdf";
var_dump($array);

// Shrink the array to a size of 2
$array->setSize(2);

// The following lines throw a RuntimeException: Index invalid or out of range
try {
    var_dump($array["non-numeric"]);
} catch (RuntimeException $re) {
    echo "RuntimeException: ".$re->getMessage()."\n";
}

try {
    var_dump($array[-1]);
} catch (RuntimeException $re) {
    echo "RuntimeException: ".$re->getMessage()."\n";
}

try {
    var_dump($array[5]);
} catch (RuntimeException $re) {
    echo "RuntimeException: ".$re->getMessage()."\n";
}
