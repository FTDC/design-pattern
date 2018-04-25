<?php
/**
 * SplObjectStorage类提供了一个从对象到数据的映射，或者通过忽略数据来提供一个对象集。这种双重用途在许多涉及到唯一标识对象的情况下是有用的
 *
 *
 */

$s = new SplObjectStorage();

$o1 = new StdClass;
$o2 = new StdClass;
$o3 = new StdClass;

$s->attach($o1);
$s->attach($o2);

var_dump($s->contains($o1));
var_dump($s->contains($o2));
var_dump($s->contains($o3));

$s->detach($o2);

var_dump($s->contains($o1));
var_dump($s->contains($o2));
var_dump($s->contains($o3));
