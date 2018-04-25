<?php
/**
 * 可在内部迭代自己的外部迭代器或类的接口。
 *
 * 执行数组定义的时候可以在
 *
 */

class myIterator implements Iterator
{
    private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );


    public function __construct()
    {
        $this->position = 0;
    }


    function rewind()
    {
        var_dump(__METHOD__);
        $this->position = 0;
    }


    function current()
    {
        var_dump(__METHOD__);

        return $this->array[$this->position];
    }


    function key()
    {
        var_dump(__METHOD__);

        return $this->position;
    }


    function next()
    {
        var_dump(__METHOD__);
        ++$this->position;
    }


    function valid()
    {
        var_dump(__METHOD__);

        return isset($this->array[$this->position]);
    }
}

$it = new myIterator;

foreach ($it as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}