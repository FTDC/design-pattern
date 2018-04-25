<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 11:26
 */

class API
{

    public function api($parameter = "", $option = "foo")
    {
        return $this->client_can_not_see($parameter);
    }


    public function doAdd($a = 0, $b = 0)
    {
        return $a + $b;
    }

    protected function client_can_not_see($name)
    {
        return "你好$name~";
    }

    public function test($string)
    {
        echo __FILE__ . "-----" . $string;
    }
}

$service = new Yar_Server (new API ());
$service->handle();
