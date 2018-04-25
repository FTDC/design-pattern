<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/25
 * Time: 10:54
 */

echo PHP_VERSION.PHP_EOL;

if (PHP_VERSION > 7):
    print_r(spl_classes());
endif;
