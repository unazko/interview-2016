<?php

require_once "SplitingClass.php";

if (defined('STDIN')) {

	if ($argc < 3) {
		echo "The input is not valid";
		exit;
	}
} else {
	echo "No input.";
	exit;
}

/*
 * Number of gems can't be less then number of adventurers
 */
if ($argv[1] > $argc - 2) {
	echo "There is no equal distribution of gems\n";
	exit;
}

$input_arr = array();

/*
 * Reading in the commad line argumets whitout the
 * name of the program and number of adventurers
 */
for ($i = 0; $i < $argc - 2; ++$i) {
	$input_arr[$i] = $argv[$i + 2];
}

/*
 * Sorting the $input_arr in descending order
 * so I can pick from the biggest gem first
 */
arsort($input_arr);

$number_adventurers = $argv[1];
$treasuers_found = 0;

/*
 * Calculating the sum of values of all gems
 */
foreach ($input_arr as $value) {
	$treasuers_found += $value;
}

$perfect_share = $treasuers_found / $number_adventurers;

if (($treasuers_found % $number_adventurers) || (max($input_arr) > $perfect_share)) {
	echo "Gems could not be equally divided!";
	exit;
}

$parts_arr = array();

/*
 * Creating empty Part objects to hold the values
 * in result of splitting
 */
for ($i = 0; $i < $number_adventurers; ++$i) {
	$parts_arr[$i] = new Part();
}

foreach ($input_arr as $value) {

	$lowest_sum_found = 0;

	/*
	 * Finding the lowest sum of all Part objects and
	 * saving it into the $lowest_sum_found
	 */
	foreach ($parts_arr as $part_to_check) {

		if ($lowest_sum_found > $part_to_check->get_sum() || $lowest_sum_found == 0) {

			$lowest_sum_found = $part_to_check->get_sum();
		}
	}

	/*
	 * Adding value from the input into to the Part object
	 * with the lowest sum
	 */
	foreach ($parts_arr as $part_to_check) {

		if ($part_to_check->get_sum() == $lowest_sum_found) {

			$part_to_check->add_value($value);
			break;
		}
	}
}

/*
 * Output the result
 */
foreach($parts_arr as $key => $part) {
	
	echo $key+1 . ": ";
	
	foreach($part->get_values() as $value) {
		
		echo $value . " ";
	}
	
	echo "\n";
}