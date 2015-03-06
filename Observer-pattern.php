<?php


/**
 * 观察者要实现的接口
 *
 * 在php SPL中已经提供SplSubject和SplOberver接口
 */
/*
 * interface SplSubject {
 *
 * function attach(SplObserver $observer);
 *
 * function detach(SplObserver $observer);
 *
 * function notify();
 * }
 *
 *
 * interface SqlObserver {
 *
 * function update(SplSubject $subject);
 * }
 */

/**
 * 观察者模式
 *
 * @abstract 观察者模式定义对象的一对多依赖,这样一来，当一个对象改变状态时，它的所有依赖者都会收到通知并自动更新!
 * @author xjin
 * @version 201503
 */
class Subject implements SplSubject {
    private $observers;
    
    // 接收观察者对象
    public function attach(SplObserver $observer)
    {
        if (! in_array($observer, $this->observers))
        {
            $this->observers[] = $observer;
        }
    }
    
    // 剔除观察者对象
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
    
    // 通知被观察者
    public function notify()
    {
        foreach ( $this->observers as $observer )
        {
            // 调用子类的统一方法
            $observer->update($this);
        }
    }
    
    // 被观察者调用的方法1
    public function setCount($count)
    {
        echo "数据量加" . $count;
    }
    
    // 被观察者调用的方法2
    public function setIntegral($integral)
    {
        echo "积分量加" . $integral;
    }
}


class Observer1 implements SplObserver {

    public function update(SplSubject $SplSubject)
    {
        $SplSubject->setCount(1);
    }
}


class Observer2 implements SplObserver {

    public function update(SplSubject $SplSubject)
    {
        $SplSubject->setIntegral(10);
    }
}


$subject = new Subject();
$subject->attach(new Observer1());
$subject->attach(new Observer2());
$subject->post(); // 输出：数据量加1 积分量加10
