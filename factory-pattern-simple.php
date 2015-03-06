<?php


/**
 * Factory-pattern 工厂模式
 *
 * @abstract 定义一个用于创建对象的接口，让子类决定实例化哪一个类。Factory Method 使一个类的实例化延迟到其子类。
 * @author xjin
 * @version 2015/3/4
 */
interface IImage {

    public function getHeight();
}

// Png 图片处理
class Image_PNG implements IImage {
    private $_width, $_height, $_data;

    public function __construct($file)
    {
        $this->_file = $file;
        $this->_parse();
    }

    private function _parse()
    {
        // 完成PNG格式的解析工作
        // 并填充$_width,$_height,$_data;
    }

    public function getHeight()
    {
        return $this->_height;
    }
}

// Jpeg 图片处理
class Image_JPEG implements IImage {
    private $_width, $_height, $_data;

    public function __construct($file)
    {
        $this->_file = $file;
        $this->_parse();
    }

    private function _parse()
    {
        // 完成JPEG格式的解析工作
        // 并填充$_width,$_height,$_data;
    }

    public function getHeight()
    {
        return $this->_height;
    }
}

// 工厂模式的应用
class ImageFactory {

    public static function factory($file)
    {
        $pathParts = pathinfo($file);
        switch (strtolower($pathParts['extension']))
        {
            case 'jpg' :
                $ret = new Image_JPEG($file);
                break;
            case 'png' :
                $ret = new Image_PNG($file);
                break;
            default :
            // 有问题
        }
        if ($ret instanceof IImage)
        {
            return $ret;
        } else
        {
            // 有问题
        }
    }
}
   
//当使用图像文件名调用 工厂方法时，根据传入的文件类型不同，取得不同对象。