<?php

/**
 * Container class that holds the sum for each part and the sequence of gems
 */
class Part {

	private $values;
	private $sum_values;

	public function __construct() {
		$this->values = array();
		$this->sum_values = 0;
	}

	public function add_value($value) {
		array_push($this->values, $value);
		$this->sum_values += $value;
	}

	public function get_values() {
		return $this->values;
	}

	public function get_sum() {
		return $this->sum_values;
	}

}