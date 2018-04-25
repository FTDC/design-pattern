<?php
/**
 * 双向链表
 *
 *
 */

$a = new SplDoublyLinkedList;
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
for ($i = 0; $i < count($arr); $i++) {
    $a->add($i, $arr[$i]);
}

$a->push(11);           //push method
$a->add(10, 12); //add method must with index
$a->shift(); //remove array first value
$a->unshift(1); //add first value

$a->rewind(); //initial from first

echo "SplDoublyLinkedList array last/top value ".$a->top()." \n";
echo "SplDoublyLinkedList array count value ".$a->count()." \n";
echo "SplDoublyLinkedList array first/top value ".$a->bottom()." \n\n";

while ($a->valid()) { //check with valid method
    echo 'key ', $a->key(), ' value ', $a->current(), "\n"; //key and current method use here
    $a->next(); //next method use here
}

$a->pop(); //remove array last value
print_r($a);
$s = $a->serialize();
echo $s;
