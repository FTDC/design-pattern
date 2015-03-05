<?php


/**
 * 观察者要实现的接口
 *
 * 在php SPL中已经提供SplSubject和SplOberver接口
 */
interface SplSubject {

    function attach(SplObserver $observer);

    function detach(SplObserver $observer);

    function notify();
}


interface SqlObserver {

    function update(SplSubject $subject);
}


/**
 * 观察者模式
 *
 * @abstract 观察者模式定义对象的一对多依赖,这样一来，当一个对象改变状态时，它的所有依赖者都会收到通知并自动更新!
 * @author xjin
 * @version 201503
 */
class Subject implements SplSubject {
    private $observers;

    public function attach(SplObserver $observer)
    {
        if (! in_array($observer, $this->observers))
        {
            $this->observers[] = $observer;
        }
    }

    public function detach(SplObserver $observer)
    {
        if (false != ($index = array_search($observer, $this->observers)))
        {
            unset($this->observers[$index]);
        }
    }

    public function post()
    {
        // post相关code
        $this->notify();
    }

    private function notify()
    {
        foreach ( $this->observers as $observer )
        {
            $observer->update($this);
        }
    }

    public function setCount($count)
    {
        echo "数据量加" . $count;
    }

    public function setIntegral($integral)
    {
        echo "积分量加" . $integral;
    }
}


class Observer1 implements SplObserver {

    public function update($subject)
    {
        $subject->setCount(1);
    }
}


class Observer2 implements SplObserver {

    public function update($subject)
    {
        $subject->setIntegral(10);
    }
}


class Client {

    public function test()
    {
        $subject = new Subject();
        $subject->attach(new Observer1());
        $subject->attach(new Observer2());
        $subject->post(); // 输出：数据量加1 积分量加10
    }
}

