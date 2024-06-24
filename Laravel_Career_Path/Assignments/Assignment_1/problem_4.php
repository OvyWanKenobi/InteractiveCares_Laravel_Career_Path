<?php

$x = readline('Input: ');

$n_star = 1;
for ($i = $x; $i > 0; $i--) {
    $str = '';
    for ($j = 1; $j < $i; $j++) {
        $str = $str . " ";
    }

    for ($k = 0; $k < $n_star; $k++) {
        $str = $str . "*";
    }

    echo $str . "\n";
    $n_star += 2;
}
