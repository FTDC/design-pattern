<?php
/**
 * 提供了堆的主要功能
 *
 * 存储树形结构数据， 前面是父级ID ， 后面是自己的ID
 * 默认按照父级ID 排序，数组第一位
 *
 * abstract SplHeap  implements Iterator  , Countable  {
 *
 *
 * public __construct(void)
 *
 * abstract protected int compare(mixed $value1 , mixed $value2 )
 * public int count(void)
 * public mixed current(void)
 * public mixed extract(void)
 * public void insert(mixed $value )
 * public bool isCorrupted(void)
 * public bool isEmpty(void)
 * public mixed key(void)
 * public void next(void)
 * public void recoverFromCorruption(void)
 * public void rewind(void)
 * public mixed top(void)
 * public bool valid(void)
 *
 */

$h = new SplMinHeap();

// [parent, child]
$h->insert([9, 11]);
$h->insert([0, 1]);
$h->insert([1, 2]);
$h->insert([1, 3]);
$h->insert([1, 4]);
$h->insert([1, 5]);
$h->insert([3, 6]);
$h->insert([2, 7]);
$h->insert([3, 8]);
$h->insert([5, 9]);
$h->insert([9, 10]);

for ($h->top(); $h->valid(); $h->next()) {
    list($parentId, $myId) = $h->current();
    echo "$myId ($parentId)\n";

    var_dump($myId, $parentId);
}


/**
 * Class MySimpleHeap
 * 堆排序
 */
class MySimpleHeap extends SplHeap
{

    /**
     * 比较两者的值， 如果前面的值比后面的值大 ，最大的排在前面
     * @param mixed $value1
     * @param mixed $value2
     * @return int|mixed
     */
    public function compare($value1, $value2)
    {
        return ($value1 - $value2);
    }
}

$obj = new MySimpleHeap();
$obj->insert(4);
$obj->insert(8);
$obj->insert(1);
$obj->insert(0);

foreach ($obj as $number) {
    echo $number."\n";
}


