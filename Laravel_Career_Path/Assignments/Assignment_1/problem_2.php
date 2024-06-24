<?php

$x = file_get_contents('problem_2_textfile.txt');

echo "Number of Words: " . str_word_count($x);
