<?php
/**
 * 跳转执行
 */


for ($i = 0; $i < 10; $i++) {
    if ($i < 7) {
        echo $i.PHP_EOL;
    } else {
        goto end;
    }
}

end:

echo "8";

