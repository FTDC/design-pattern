<?php
/**
 * SplStack类通过使用一个双向链表来提供栈的主要功能。
 *
 * 实现 -- 后进先出
 *
 */


//SplStack Mode is LIFO (Last In First Out)

$q = new SplStack();

$q[] = 1;
$q[] = 2;
$q[] = 3;
$q->push(4);
$q->add(4, 5);

$q->rewind();
while ($q->valid()) {
    echo $q->current(), "\n";
    $q->next();
}




