<?php


/**
 * 抽象工厂方法
 *
 * @abstract 操作类 因为包含有抽象方法，所以类必须声明为抽象类
 * @author xjin
 * @version 20150305
 */

// 抽象类 子类继承实现抽象方法
abstract class Operation {
    // 抽象方法不能包含函数体
    abstract public function getValue($num1, $num2);
    // 强烈要求子类必须实现该功能函数
}


/**
 * 加法类
 */
class OperationAdd extends Operation {

    public function getValue($num1, $num2)
    {
        return $num1 + $num2;
    }
}


/**
 * 减法类
 */
class OperationSub extends Operation {

    public function getValue($num1, $num2)
    {
        return $num1 - $num2;
    }
}


/**
 * 乘法类
 */
class OperationMul extends Operation {

    public function getValue($num1, $num2)
    {
        return $num1 * $num2;
    }
}


/**
 * 除法类
 */
class OperationDiv extends Operation {

    public function getValue($num1, $num2)
    {
        try
        {
            if ($num2 == 0)
            {
                throw new Exception("除数不能为0");
            } else
            {
                return $num1 / $num2;
            }
        } catch ( Exception $e )
        {
            echo "错误信息：" . $e->getMessage();
        }
    }
}
