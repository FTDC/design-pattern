<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 11:58
 */

$arr = [1, 2, 3, 4, 5];

foreach($arr as $key => $value) {
    echo $key . ' => ' . $value . "\n";
}

class MyIterator implements Iterator {
    private $position = 0;
    private $arr = [
        'first', 'second', 'third',
    ];

    public function __construct() {
        $this->position = 0;
    }

    public function rewind() {
        var_dump(__METHOD__);
        $this->position = 0;
    }

    public function current() {
        var_dump(__METHOD__);
        return $this->arr[$this->position];
    }

    public function key() {
        var_dump(__METHOD__);
        return $this->position;
    }

    public function next() {
        var_dump(__METHOD__);
        ++$this->position;
    }

    public function valid() {
        var_dump(__METHOD__);
        return isset($this->arr[$this->position]);
    }

}

$it = new MyIterator();

foreach($it as $key => $value) {
    echo "\n";
    var_dump($key, $value);
}


function printer() {
    $i = 1;
    while(true) {
        echo 'this is the yield ' . (yield $i) . "\n";
        $i++;
    }
}

$printer = printer();
var_dump($printer->send('first'));
var_dump($printer->send('second'));