<?php
/**
 * SplMinHeap类提供了堆的主要功能，保持了顶部的最小值。
 */


$obj = new SplMinHeap();
$obj->insert(4);
$obj->insert(8);
$obj->insert(1);
$obj->insert(0);

foreach ($obj as $number) {
    echo $number."\n";
}