<?php

/**
 * 装饰模式
 *
 * @abstract 又名包装模式，装饰器模式以客户端透明的方式扩展对象的功能。 
 *           装饰器模式使用原来被装饰的类的一个子类的实例，把客户端的调用委派到被装饰类
 *           装饰器模式的关键在于这种扩展时完全透明的。
 * @author xjin
 * @version 20150310
 */

// 被装饰对象
class UserInfo{
    public $userInfo = array();

    public function addUser($userInfo) {
        $this->userInfo[] = $userInfo;
    }


    public function getUserList() {
        print_r($this->userInfo);
    }

}

// 装饰器 
class UserInfoDecorate{

    public function makeCaps($UserInfo) {
        foreach($UserInfo->userInfo as &$val) {
            $val = strtoupper($val);
        }
    }

}

$UserInfo = new UserInfo();
$UserInfo->addUser('zhu');
$UserInfo->addUser('initphp');

$UserInfoDecorate = new UserInfoDecorate();

//  装饰没有个userInfo  对象
$UserInfoDecorate->makeCaps($UserInfo);
$UserInfo->getUserList();
