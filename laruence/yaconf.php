<?php
/**
 * yac.enable = 1
 *
 * yac.keys_memory_size = 4M ; 4M can get 30K key slots, 32M can get 100K key slots
 *
 * yac.values_memory_size = 64M
 *
 * yac.compress_threshold = -1
 *
 * yac.enable_cli = 0 ; whether enable yac with cli, default 0
 */


$yac = new Yac();

$yac->set("foo", "bar");

$yac->set(
    array(
        "dummy" => "foo",
        "dummy2" => "foo",
    )
);
$yac->get("dummy");
$yac->get(array("dummy", "dummy2"));


