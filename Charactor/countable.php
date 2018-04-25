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


class  iterator implements OuterIterator
{

    /**
     * Return the current element
     * @link  http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        // TODO: Implement current() method.
    }


    /**
     * Move forward to next element
     * @link  http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        // TODO: Implement next() method.
    }


    /**
     * Return the key of the current element
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        // TODO: Implement key() method.
    }


    /**
     * Checks if current position is valid
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        // TODO: Implement valid() method.
    }


    /**
     * Rewind the Iterator to the first element
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }


    /**
     * Returns the inner iterator for the current entry.
     * @link  http://php.net/manual/en/outeriterator.getinneriterator.php
     * @return Iterator The inner iterator for the current entry.
     * @since 5.1.0
     */
    public function getInnerIterator()
    {
        // TODO: Implement getInnerIterator() method.
    }
}


