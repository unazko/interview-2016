<?php

/**
 * Converts positive decimal number to binary string
 * @param int $number
 * @return string
 */
function int2binary($number) {

	$positive_number = abs($number);
	
	if ($positive_number == 0) {
		return 0;
	}

	$binary_string = "";

	/*
	 * Getting the remainders of the division by two
	 * and adding them in reverse order into $binary_string
	 */
	while ($positive_number != 0) {

		$value = $positive_number % 2;
		$binary_string = $value . $binary_string;
		$positive_number = floor($positive_number / 2);
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