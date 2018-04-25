<?php
/**
 * SplMaxHeap类提供了堆的主要功能，在顶部保持最大值。
 */


$obj = new SplMaxHeap();
$obj->insert(4);
$obj->insert(8);
$obj->insert(1);
$obj->insert(0);

foreach ($obj as $number) {
    echo $number."\n";
}
