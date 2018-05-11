<?php
/**
 * SplMinHeap类提供了堆的主要功能，保持了顶部的最小值。
 */


$obj = new SplMinHeap();
//$obj->insert(4);
//$obj->insert(8);
//$obj->insert(1);
//$obj->insert(0);
$obj->insert("sd");
$obj->insert("z");
$obj->insert("b");
foreach ($obj as $number) {
    echo $number . "\n";
}

$h = new SplMinHeap();

// [parent, child]
$h->insert([9, "sdfew","sfe"]);
$h->insert([0, 1]);

for ($h->top(); $h->valid(); $h->next()) {
    list($parentId, $myId) = $h->current();
    echo "$myId ($parentId)\n";
}