
<?php

$x = readline('Input:');

$arr = explode(' ', $x);

for ($i = 0; $i < count($arr); $i++) {
    $arr[$i] = strrev($arr[$i]) . ' ';
}

echo implode('', $arr);
