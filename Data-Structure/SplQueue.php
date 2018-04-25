<?php
/**
 * SplQueue 类通过使用一个双向链表来提供队列的主要功能。
 *
 *
 */

$queue = new SplQueue();
$queue->enqueue('A');
$queue->enqueue('B');
$queue->enqueue('C');

$queue->rewind();

while ($queue->valid()) {
    echo $queue->current(), "\n";
    $queue->next();
}

print_r($queue);
$queue->dequeue(); //remove first one
print_r($queue);

?>
