<?php

/**
 * Converts positive decimal number to binary string
 * @param int $number
 * @return string
 */
function int2binary($number) {

	if ($number == 0) {
		return 0;
	}

	$result_string = "";
	
	for($i = 0; $i < (PHP_INT_SIZE * 8); ++$i) {
		/**
		 * Using right shift ">>" and operator "&" 32-64 times 
		 * to get the bits from every 32-64 bit integer
		 * depending from PHP_INT_SIZE
		 */
		$bit = ($number >> $i) & 1;
		/**
		 * Appending every $bit value as a string 
		 * in the beginning of the $result_string
		 */
		$result_string = $bit . $result_string;
	}
	/**
	 * Get rid of all zeros in the left
	 */
	$result_string = ltrim($result_string, "0");

	
	return $result_string;
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