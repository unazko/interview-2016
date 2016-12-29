<?php

/**
 * Converts positive decimal number to binary string
 * @param int $number
 * @return string
 */
function int2binary($number) {

	if ($number < 0) {
		echo "Doesn't work with negative numbers.";
		exit;
	}

	if ($number == 0) {
		return 0;
	}

	$binary_string = "";
	$binary_values = array();

	/*
	 * Getting the remainders of the division by two
	 * in reverse order and pushing them into an array
	 */
	while ($number != 0) {

		$value = $number % 2;
		array_push($binary_values, $value);
		$number = floor($number / 2);
	}

	/*
	 * Popping values from the back of the array
	 * and adding them into a string
	 * which reverses the order of values into the right direction
	 */
	while (count($binary_values)) {

		$binary_string .= array_pop($binary_values);
	}

	return $binary_string;
}

if (defined('STDIN')) {

	if ($argc != 2 || !is_numeric($argv[1])) {
		echo "Invalid input";
		exit;
	}
} else {

	echo "No input";
	exit;
}

echo int2binary((int)$argv[1]);