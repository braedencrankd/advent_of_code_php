<?php

// Path: part_01.php

// ownerproof-3488570-1701468729-e91171151ca0

// file input
$input = file_get_contents('input.txt');

// split input into array
$calibration_values = explode("\n", $input);

$new_array = [];
foreach ($calibration_values as $value) {
  // find the first two numbers in the string

  // filter string for the first two numbers
  $matches = preg_replace('/[^0-9]/', '', $value);

  // get the first digit and the last digit
  $matches = substr($matches, 0, 1) . substr($matches, -1);

  $new_array[] = $matches;
}

$sum = array_reduce($new_array, function ($carry, $item) {
  return $carry + $item;
});

echo $sum;
