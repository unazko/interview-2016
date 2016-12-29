<?php

if (defined('STDIN')) {
	if ($argc != 2) {
		echo "Invalid count of arguments.";
		exit;
	}
} else {
	exit;
}

/*
 * read the xml file from the project folder into simple xml object
 */
$xml = simplexml_load_file($argv[1]) or die("Error: Cannot create object");

$hat_one = array();

foreach ($xml->children() as $name) {
	array_push($hat_one, $name);
}

/*
 * making sure all names in the input file are unique
 */
array_unique($hat_one);

/*
 * hat_one is representing the left side of the output
 * hat_two is representing the right side of the output
 */
$hat_two = $hat_one;

/*
 * randomizing all names in the two hats
 */
shuffle($hat_one);
shuffle($hat_two);

$hat_one_size = count($hat_one);
$hat_two_size = count($hat_two);

/*
 * to be the output arrays
 */
$left = array();
$right = array();

/*
 * loop until all names are withdrawed from the hats
 */
while ($hat_one_size || $hat_two_size) {

	/*
	 * draw a name from the back of each hat
	 */
	$pop_one = array_pop($hat_one);
	$pop_two = array_pop($hat_two);

	if ($pop_one == $pop_two) {

		/*
		 * if drawed names are the same
		 * put one of the drawed names back
		 * and draw again but from the front
		 */
		array_push($hat_one, $pop_one);
		$pop_one = array_shift($hat_one);
	}
	--$hat_one_size;
	--$hat_two_size;

	array_push($left, $pop_one);
	array_push($right, $pop_two);
}

/*
 * Output the result
 */
for ($i = 0; $i < count($left); ++$i) {

	echo $left[$i];
	echo " - ";
	echo $right[$i];
	echo "\n";
}

//var_dump(array_combine($left, $right));