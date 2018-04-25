<?php
/**
 * 自定义序列化的接口。  序列化对象的时候处理
 *
 * 实现此接口的类将不再支持 __sleep() 和 __wakeup()。不论何时，只要有实例需要被序列化，serialize 方法都将被调用。
 * 它将不会调用 __destruct() 或有其他影响，除非程序化地调用此方法。当数据被反序列化时，类将被感知并且调用合适的
 * unserialize() 方法而不是调用 __construct()。如果需要执行标准的构造器，你应该在这个方法中进行处理。
 */

class obj implements Serializable
{
    private $data;


    public function __construct()
    {
        $this->data = array("name" => "lucus", "sex" => "man");
    }


    public function serialize()
    {
//        return serialize($this->data);
        echo "serialize".PHP_EOL;
        $this->data = json_encode($this->data);

        return json_encode($this->data);
    }


    public function unserialize($data)
    {
        echo "unserizlize".PHP_EOL;
        $this->data = json_decode($data);
    }


    public function getData()
    {
        return $this->data;
    }
}

$obj = new obj;
$ser = serialize($obj);
var_dump($ser);
var_dump($obj->getData());

//$newobj = unserialize($ser);
//var_dump($newobj);
//var_dump($newobj->getData());