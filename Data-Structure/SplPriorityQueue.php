<?php
/**
 *
 * SplPriorityQueue类提供了优先队列的主要功能，使用最大堆实现。
 *
 */

$q = new SplPriorityQueue;

$q->insert('foo', 0);
$q->insert('bar', 0);
$q->insert('baz', 0);

//var_dump($q->extract());
//var_dump($q->extract());
//var_dump($q->extract());


while ($q->valid()) {
//    var_dump($q->extract());
    var_dump($q->current());
    $q->next();
}