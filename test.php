<?php
function getFibonacci()
{
    $i = 0;
    $k = 1;

    yield $k;

    while (true) {
        $k = $i + $k;

        $i = $k - $i;

        yield $k;
    }
}

$y = 0;

foreach (getFibonacci() as $fibonacci) {
    echo $fibonacci . "\n";

    $y++;
    if ($y > 30) {
        break;
    }
}