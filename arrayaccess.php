<?php

/**
 * （数组式访问）接口
 *
 * 提供像访问数组一样访问对象的能力的接口。
 */

class obj implements arrayaccess
{
    private $container = array();


    public function __construct()
    {
        $this->container = array(
            "one" => 1,
            "two" => 2,
            "three" => 3,
        );
    }


    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }


    /**
     * 提供像访问数组一样访问对象的能力的接口。
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }


    /**
     * 复位一个偏移位置的值
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }


    /**
     * 获取一个偏移位置的值
     *
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}

$obj = new obj;

var_dump(isset($obj["two"]));
var_dump($obj["two"]);


unset($obj["two"]);
var_dump(isset($obj["two"]));

$obj["two"] = "A value";
var_dump($obj["two"]);

$obj[] = 'Append 1';
$obj[] = 'Append 2';
$obj[] = 'Append 3';
print_r($obj);