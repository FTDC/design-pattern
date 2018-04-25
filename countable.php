<?php
/**
 * 类实现 Countable 可被用于 count() 函数.
 */

class counter implements Countable
{
    public function count()
    {
        // Number of IPv6 addresses in a single /32 IPv6 allocation (2^96)
//        return "18446744073709551616"; // assume generated/exported by big-int library(GMP/BC/etc.)
        return "12312322"; // assume generated/exported by big-int library(GMP/BC/etc.)
    }
}

$obj = new counter();

echo $obj->count().PHP_EOL; // prints string "18446744073709551616"
echo count($obj);    // prints int PHP_INT_MAX