<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 11:26
 */

//$client = new Yar_Client("http://www.zys.cn/yar_server.php");
////$client->setOpt("");
//
//$result = $client->test("parameter");
//echo $result . '<hr>';
//echo $client->doAdd(10, 20);


function callback($retval, $callinfo)
{
    if ($callinfo == NULL) {
        echo "现在, 所有的请求都发出去了, 还没有任何请求返回\n";
    } else {
        echo "这是一个远程调用的返回, 调用的服务名是", $callinfo["method"],
        ". 调用的sequence是 ", $callinfo["sequence"], "\n";
        var_dump($retval);
    }
}

function error_callback($type, $error, $callinfo)
{
    error_log($error);
}


try {

} finally {

}


$result = array();

$result[] = Yar_Concurrent_Client::call("http://www.zys.cn/yar_server.php", "test", array("parameters"), "callback");

$result[] = Yar_Concurrent_Client::call("http://www.zys.cn/yar_server.php", "test", array("parameters"));
// if the callback is not specificed,
// callback in loop will be used
$result[] = Yar_Concurrent_Client::call("http://www.zys.cn/yar_server.php", "test", array("test"), "callback", NULL, array(YAR_OPT_PACKAGER => "json"));
//this server accept json packager
$result[] = Yar_Concurrent_Client::call("http://www.zys.cn/yar_server.php", "test", array("test"), "callback", NULL, array(YAR_OPT_TIMEOUT => 1));
//custom timeout

var_dump($result);

Yar_Concurrent_Client::loop("callback", "error_callback"); //send the requests,
//the error_callback is optional




