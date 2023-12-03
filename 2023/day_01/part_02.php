<?php
// Path: part_02.php

$input = file_get_contents('input.txt');

$calibration_values = explode("\n", $input);

$number_map = [
  "one" => 1,
  "two" => 2,
  "three" => 3,
  "four" => 4,
  "five" => 5,
  "six" => 6,
  "seven" => 7,
  "eight" => 8,
  "nine" => 9
];


$matches = [];

foreach ($calibration_values as $key => $value) {

  $str_array = str_split($value);
  $current_string = "";

  foreach ($str_array as $pos => $char) {
    $current_string .= $char;

    if (is_numeric($char)) {
      $matches[$key][] = $char;
      continue;
    }

    // check if any substring of the current string match any of the keys in the $number_map
    foreach ($number_map as $number => $value) {
      if (strpos($current_string, $number) !== false) {
        $matches[$key][] = $value;

        // remove the matched substring from the current string but keep the last character for potential other $matches
        $current_string = substr($current_string, 0, -strlen($number)) . substr($current_string, -1);
        break;
      }
    }
  }
}

// Combine first and last number in each array
foreach ($matches as $key => $value) {
  $combined = $value[0] . $value[count($value) - 1];

  if (is_numeric($combined)) {
    $matches[$key] = $combined;
  }
}

$sum = array_reduce($matches, function ($carry, $item) {
  if (empty($item)) {
    return $carry;
  }
  return $carry + $item;
});

echo $sum . "\n";
