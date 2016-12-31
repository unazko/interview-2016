<?php
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
		echo "There is no equal share.\n";
		exit;
	}

	$share_number = $argv[1];
	$input_arr = array();
	
	/*
	 * Reading in the commad line argumets whitout the
	 * name of the program and number of adventurers
	 */
	for($i = 2; $i < $argc; ++$i) {
		
		$input_arr[$i - 2] = $argv[$i];
	}
	
	/*
	 * Calculating the sum of values of all gems
	 */
	$sum = array_sum($input_arr);
	
	if($sum % $share_number != 0) {
		echo "There is no equal share.\n";
		exit;
	}
	
	$searched_sum = $sum / $share_number;
	
	
	/*
	 * Sorting the $input_arr in descending order
	 * so I can pick from the biggest gem first
	 */
	rsort($input_arr);

	/*
	 * If any gem is worth more than the searched sum
	 * then the gems cannot be devided equally
	 */
	foreach($input_arr as $value) {
		
		if($value > $searched_sum) {
			echo "There is no equal share.\n";
			exit;
		}
	}
	
	/*
	 * Function that takes array of ints and an int sum
	 * and returns subarray of ints 
	 * with sum equal to the input sum
	 */
	function part_find($arr_to_search, $sum_to_find) {
		
		$deletion_index = 1;
		/*
		 * Loop that starts from the biggest element
		 * and tries every next element in line to see if it fits to the sequеnce
		 * if not deletes it and tries again
		 */
		while (count($arr_to_search) != 1) {
		
			$share = array();
			$construct_sum = 0;
			$saved_key = 0;
			$arr_cpy = $arr_to_search;
			$counter = 0;
			
			/*
			 * Loop that excludes sequentially the last value that 
			 * didnt't surpass the $searched_sum
			 */
			while($counter < count($arr_to_search)) {

				++$counter;
				foreach($arr_cpy as $key => $value) {
				
					$construct_sum += $value;
					$share[] = $value;
					
					if($construct_sum > $sum_to_find) {

						/*
						 * If $construct_sum surpasses the $searched_sum
						 * revert the $construct_sum with the last element
						 * and go on
						 */
						$construct_sum -= $value;
						array_pop($share);
					}
					else if($construct_sum == $sum_to_find) {
						
						/*
						 * If the sequence is found return it to the caller
						 */
						return $share;
					} 
					else {
						/*
						 * Saves the last key which didn't surpass the $searched_sum
						 * so it can try without that element in the next iteration
						 */
						$saved_key = $key;
					}
				}
				/*
				 * If the $searched_sum haven't been found
				 * try again without the $saved_key element
				 */
				unset($arr_cpy[$saved_key]);
				$share = array();
				$construct_sum = 0;
			}
			
			unset($arr_to_search[$deletion_index]);
			++$deletion_index;
		}
		/*
		 * If the sequence have't been found return a msg
		 */
		return "There is no equal share.\n";
	}
	
	/*
	 * Find $share_number - 1 subarrays with a given sum
	 */
	for($i = 0; $i < $share_number - 1; ++$i) {
		
		$output = part_find($input_arr, $searched_sum);
		
		if(is_array($output)) {
			
			echo ($i + 1) . ":  ";
			foreach($output as $value) {
				echo $value;
				echo " ";
			}
			echo "\n";
			
			/*
			 * remove the subarray elemets from the main array
			 * so we can find the next subarray
			 */
			foreach($output as $output_val) {

				unset($input_arr[array_search($output_val, $input_arr)]);
			}
		}else {
			echo $output;
		}
	}
	
	/*
	 * Print out the last remaining elements from the input array
	 * if thir sum is equal to the $searched_sum
	 */
	if(array_sum($input_arr) == $searched_sum){
		
		echo $share_number . ":  ";
		foreach($input_arr as $value) {
			echo $value;
			echo " ";
		}	 
	} 
	else {
		echo "There is no equal share.\n";
	}
?>