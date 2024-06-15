<?php

$x = readline('Input: ');

$arr = (explode(' ', $x));

$min = abs($arr[0]);

for ($i = 1; $i < count($arr); $i++) {
    global $min;
    if (abs($arr[$i]) < $min) {
        $min = abs($arr[$i]);
    }
}

echo 'Output: ' . $min;
